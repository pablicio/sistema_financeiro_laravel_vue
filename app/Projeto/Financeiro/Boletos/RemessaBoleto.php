<?php namespace App;

use App\Entities\Entity;
use App\Entities\Financeiro\ContasAReceber;
use Eduardokum\LaravelBoleto\Boleto\Render\Pdf;
use Illuminate\Support\Facades\Storage;

class RemessaBoleto extends Entity
{
    protected $table = 'remessa_boletos';

    const FORMA_PGTO = 4;

    protected $fillable = [
        'remessa_id',
        'boleto_id'
    ];

    public function beneficiario($unidade)
    {
        $beneficiario = new \Eduardokum\LaravelBoleto\Pessoa([
            'nome' => $unidade->razao_social,
            'endereco' => $unidade->endereco,
            'cep' => $unidade->cep,
            'uf' => $unidade->cidade->estado->nome,
            'cidade' => $unidade->cidade->nome,
            'documento' => $unidade->cnpj,
        ]);

        return $beneficiario;
    }

    public function remessa()
    {
        return $this->belongsTo(Remessa::class, 'remessa_id');
    }

    public function createRemessa($pathRem, $pathPdf, $unidade_id, $totalBoletos)
    {
        return Remessa::create([
            'nome_arquivo_remessa' => explode('\\', $pathRem)[2],
            'link_arquivo_remessa' => $pathRem,
            'nome_arquivo_pdf' => explode('\\', $pathPdf)[2],
            'link_arquivo_pdf' => $pathPdf,
            'total_boletos' => $totalBoletos
        ]);
    }

    public function getLastRemessaID($unidade)
    {
        return parent::all()
                ->where('unidade_id', $unidade)
                ->pluck('id')
                ->last() ?? 0;
    }

    public function salvarArquivoPDF($boletos, $path)
    {
        $pdf = new Pdf();

        $pdf->addBoletos($boletos);

        $pdf_string = $pdf->gerarBoleto($pdf::OUTPUT_STRING);

        Storage::put($path, $pdf_string);

        return Storage::url($path);
    }

    public function salvarArquivoRemessa($remessa, $path)
    {
        Storage::put($path, $remessa);

        return Storage::url($path);
    }

    public function gerarHashArquivoPDF()
    {
        return
            'pdf' .
            DIRECTORY_SEPARATOR . str_random(15) .
            DIRECTORY_SEPARATOR . str_random(10) . '.pdf';
    }

    public function gerarHashArquivoRemessa()
    {
        return
            'remessa' .
            DIRECTORY_SEPARATOR . str_random(15) .
            DIRECTORY_SEPARATOR . 'CB' . date('dmy') . '.REM';
    }

    public function vincularBoletosARemessa($remessa, $boletos)
    {
        foreach ($boletos as $boleto)
            $this->create([
                'remessa_id' => $remessa->id,
                'boleto_id' => $boleto->id
            ]);
    }

    public function gerarRemessa()
    {
        $total = \DB::select(
            'SELECT COUNT(*) as total FROM contas_a_receber WHERE forma_de_pagamento_id = ' . self::FORMA_PGTO . ' AND deleted_at IS NULL AND id NOT IN (
                SELECT boleto_id FROM remessa_boletos WHERE deleted_at IS NULL
            )'
        );

        for ($offset = 1; $offset <= $total[0]->total; $offset += 100) {
            self::gerarArquivosRemessa($offset);

        }
    }


    public function gerarArquivosRemessa($offset)
    {
        $boletos_ids = \DB::select(
            'SELECT * FROM contas_a_receber WHERE forma_de_pagamento_id = ' . self::FORMA_PGTO . ' AND deleted_at IS NULL AND id NOT IN (
                SELECT boleto_id FROM remessa_boletos WHERE deleted_at IS NULL
            ) LIMIT 10 OFFSET 1'
        );

        $boletos_ids = array_pluck($boletos_ids, 'id');

        $contas_a_receber = new ContasAReceber();

        $contas_a_receber = $contas_a_receber
            ->whereIn('id', $boletos_ids)
            ->get();

        if (count($contas_a_receber)) {
            $unidades = $contas_a_receber->groupBy('unidade_id')->collapse()->unique('unidade_id');

            foreach ($unidades as $unidade) {
                $idRemessa = $this->getLastRemessaID($unidade->unidades->id) + 1;

                $remessaArray = [
                    'idRemessa' => $idRemessa,
                    'agencia' => $unidade->unidades->contaBancaria->agencia,
                    'carteira' => $unidade->unidades->contaBancaria->carteira,
                    'conta' => $unidade->unidades->contaBancaria->conta,
                    'contaDv' => $unidade->unidades->contaBancaria->conta_dv,
                    'codigoCliente' => '12345678901234567890',
                    'beneficiario' => $this->beneficiario($unidade->unidades)
                ];

                ${'remessa_' . $unidade->unidades->id} = new \Eduardokum\LaravelBoleto\Cnab\Remessa\Cnab400\Banco\Bradesco($remessaArray);

                $boletos_da_unidade = $contas_a_receber->where('unidade_id', $unidade->unidades->id);

                $array_boletos_pdf = [];

                foreach ($boletos_da_unidade as $boleto) {
                    $pagador = new \Eduardokum\LaravelBoleto\Pessoa([
                        'nome' => $boleto->cliente->nome,
                        'endereco' => $boleto->cliente->endereco,
                        'bairro' => $boleto->cliente->bairro,
                        'cep' => $boleto->cliente->cep,
                        'uf' => $boleto->cliente->cidade->estado->uf,
                        'cidade' => $boleto->cliente->cidade->nome,
                        'documento' => $boleto->cliente->pessoa == 'Física' ? $boleto->cliente->cpf : $boleto->cliente->cnpf,
                    ]);

                    $boleto_formato_rem = [
                        'logo' => '',
                        'dataVencimento' => new \Carbon\Carbon($boleto->data_vencimento),
                        'valor' => $boleto->valor,
                        'multa' => false,
                        'desconto' => false,
                        'juros' => false,
                        'juros_apos' => 1,
                        'diasProtesto' => false,
                        'diasBaixaAutomatica' => 60,
                        'numero' => $boleto->id,
                        'numeroDocumento' => $boleto->id,
                        'pagador' => $pagador,
                        'beneficiario' => $this->beneficiario($boleto->unidades),
                        'agencia' => $boleto->unidades->contaBancaria->agencia,
                        'conta' => $boleto->unidades->contaBancaria->conta,
                        'carteira' => $boleto->unidades->contaBancaria->carteira,
                        'descricaoDemonstrativo' => [
                            'Pagamento referente ao invoice de id #' . $boleto->invoices->id . ' e do contrato de id #' . $boleto->invoices->contrato->id,
                        ],
                        'instrucoes' => [
                            '- Sr. Caixa, cobrar multa de 2% após o vencimento.',
                            '- Sr. Caixa, cobrar 1% de juros moratórios ao mês.',
                            '- Receber até cinco dias apóes o vencimento.',
                            '- Após cinco dias do vencimento, o boleto estará sujeito à protesto.',
                            '- Em caso de dúvidas, entre em contato conosco: contato@guardebem.com',
                        ],
                        'aceite' => 'N',
                        'especieDoc' => 'DS',
                    ];

                    $boleto_interface = new \Eduardokum\LaravelBoleto\Boleto\Banco\Bradesco($boleto_formato_rem);

                    $array_boletos_pdf[] = $boleto_interface;

                    $remessa_gerada = ${'remessa_' . $boleto->unidades->id}->addBoleto($boleto_interface)->gerar();
                }

                $path_arquivo_pdf = self::gerarHashArquivoPDF();

                $path_arquivo_remessa = self::gerarHashArquivoRemessa();

                $urlPdf = self::salvarArquivoPDF($array_boletos_pdf, $path_arquivo_pdf);

                $urlRemessa = self::salvarArquivoRemessa($remessa_gerada, $path_arquivo_remessa);

                $remessa = self::createRemessa($urlRemessa, $urlPdf, $boleto->unidades->id, count($array_boletos_pdf));

                self::vincularBoletosARemessa($remessa, $boletos_da_unidade);
            }
        }
    }
}
