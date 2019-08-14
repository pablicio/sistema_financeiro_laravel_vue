<?php namespace App;

use App\Entities\Entity;
use App\Entities\Financeiro\ContaContabilValor;
use App\Entities\Financeiro\ContasAReceber;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Facades\Datatables;

class RetornoRemessa extends Entity
{
    const CONTA_ID = 4;

    protected $table = 'retornos';

    protected $fillable = [
        'nome',
        'link'
    ];

    const COLUMNS_OF_DATATABLE = [
        ['data' => 'documento', 'name' => 'documento', 'title' => 'Baixar Arquivo RET'],
        ['data' => 'deletar', 'name' => 'deletar', 'title' => 'Deletar']
    ];

    public function datatable($retornos)
    {
        return Datatables::of($retornos)
            ->addColumn('documento', function ($documento) {
                return '<td class="text-center"> <a href="' . $documento->link . '">' . $documento->nome . '</a></td>';
            })
            ->addColumn('deletar', function ($documento) {
                return '<td class="text-center"><a href="/admin/retorno_remessa/delete/' . $documento->id . '">Deletar</a></td>';
            })->make(true);
    }

    public function saveRet($path, $file)
    {
        Storage::put($path, $file);

        return Storage::url($path);
    }

    public function createContaContabilValor($boletos) {

        $conta_receber = ContasAReceber::whereNotNull('data_pagamento')->pluck('id')->toArray();

        $valores_create = [];
        foreach($boletos as $boleto){
            if(in_array($boleto['boleto_id'],$conta_receber)) {
                $newArray = [
                    'conta_id' => self::CONTA_ID,
                    'conta_pagar_id' => null,
                    'conta_receber_id' => $boleto['boleto_id'],
                    'data_pagamento' => $boleto['data_credito'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                $valores_create[] = $newArray;
            }
        }

        ContaContabilValor::insert($valores_create);
    }

    public function updateContasReceberByRetorno($retorno_id)
    {
        DB::table('contas_a_receber')
            ->join('retorno_boletos', 'retorno_boletos.boleto_id', '=', 'contas_a_receber.id')
            ->where('retorno_boletos.retorno_id', $retorno_id)
            ->update([
                'contas_a_receber.data_pagamento' => DB::raw('retorno_boletos.data_credito')
            ]);
    }

    public function createRetornoBoleto($detalhes, $file_name, $file)
    {
        $data_credito = null;
        $boletos = [];
        foreach ($detalhes as $detalhe) {
            if (!is_null($detalhe->dataCredito)) {
                $juros_boleto = floatval($detalhe->valorMora) + floatval($detalhe->valorMulta);
                $data_credito = Carbon::parse($detalhe->dataCredito)->format('Y-m-d');

                $boletos[] = [
                    'boleto_id' => $detalhe->numeroDocumento,
                    'data_credito' => $data_credito,
                    'valor' => $detalhe->valor,
                    'valor_tarifa' => $detalhe->valorTarifa,
                    'juros_boleto' => $juros_boleto
                ];
            }
        }

        $retornos_boletos = RetornoBoleto::where('data_credito', $data_credito)->pluck('boleto_id')->toArray();

        $boletos_autorizados = array_diff_assoc(array_pluck($boletos, 'boleto_id'), $retornos_boletos);

        $boletos = collect($boletos)->whereIn('boleto_id', $boletos_autorizados)->toArray();

        if (count($boletos)) {

            $url = $this->saveRet($file_name, $file);

            $retorno = self::create([
                'nome' => explode('\\',$file_name)[2],
                'link' => $url,
            ]);

            $boletos_create = [];
            foreach ($boletos as $boleto)
                $boletos_create[] = array_merge($boleto, ['retorno_id' => $retorno->id]);

            RetornoBoleto::insert($boletos_create);

            $this->updateContasReceberByRetorno($retorno->id);

            $this->createContaContabilValor($boletos);
        }
    }

    public function retornoRemessa($request)
    {
        $retorno = \Eduardokum\LaravelBoleto\Cnab\Retorno\Factory::make($request->doc->path());

        $file = file_get_contents($request->doc->path());

        $file_name = 'retorno' . DIRECTORY_SEPARATOR . str_random(20) . DIRECTORY_SEPARATOR . $request->doc->getClientOriginalName();

        $detalhes = $retorno->getDetalhes();

        $this->createRetornoBoleto($detalhes, $file_name, $file);

        return redirect()->back();
    }
}
