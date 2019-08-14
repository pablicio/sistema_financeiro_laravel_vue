<?php
/**
 * Created by PhpStorm.
 * User: Chronos Tecnologia
 * Date: 16/05/2017
 * Time: 13:04
 */

namespace App\Entities\Financeiro;


use App\Entities\Unidade;

class Boleto
{
    public function beneficiario($unidade)
    {
        $beneficiario = new \Eduardokum\LaravelBoleto\Pessoa([
            'nome' => $unidade->razao_social,
            'endereco' => $unidade->endereco,
            'cep' => $unidade->cep,
            'uf' => $unidade->cidade->estado->nome,
            'cidade' =>  $unidade->cidade->nome,
            'documento' =>  $unidade->cnpj,
        ]);

        return $beneficiario;
    }

    public function pagador($cliente)
    {
        $pagador = new \Eduardokum\LaravelBoleto\Pessoa([
            'nome' => $cliente->nome,
            'endereco' => $cliente->endereco,
            'bairro' => $cliente->bairro,
            'cep' => $cliente->cep,
            'uf' => $cliente->cidade->estado->uf,
            'cidade' => $cliente->cidade->nome,
            'documento' => $cliente->pessoa == 'Física' ? $cliente->cpf : $cliente->cnpf,
       ]);

        return $pagador;
    }

    public function generateBoleto($conta, $pagador, $beneficiario, $contaBancaria)
    {
        $boletoArray = [
            'logo' => 'assets/pdf/logo-remessa-boleto.png', // Logo da empresa
            'dataVencimento' => new \Carbon\Carbon($conta->data_vencimento),
            'valor' => $conta->valor,
            'multa' => false, // porcento
            'desconto' => $conta->desconto, // porcento
            'juros' => false, // porcento ao mes
            'juros_apos' => 1, // juros e multa após
            'diasProtesto' => false, // protestar após, se for necessário
            'diasBaixaAutomatica' => 60,
            'numero' => $conta->id,
            'numeroDocumento' => $conta->id,
            'beneficiario' => $beneficiario, // Objeto PessoaContract
            'pagador' => $pagador, // Objeto PessoaContract
            'agencia' => $contaBancaria['agencia'], // BB, Bradesco, CEF, HSBC, Itáu
            'agenciaDv' => $contaBancaria['agencia_dv'], // se possuir
            'conta' => $contaBancaria['conta'], // BB, Bradesco, CEF, HSBC, Itáu, Santander
            'contaDv' => $contaBancaria['conta_dv'], // Bradesco, HSBC, Itáu
            'carteira' => $contaBancaria['carteira'] , // BB, Bradesco, CEF, HSBC, Itáu, Santander
            'descricaoDemonstrativo' => [
                'Pagamento referente ao invoice #id e do contrato #id tipo ',
            ], // máximo de 5
            'instrucoes' => [
                '- Sr. Caixa, cobrar multa de 2% após o vencimento.',
                '- Sr. Caixa, cobrar 1% de juros moratórios ao mês.',
                '- Receber até cinco dias apóes o vencimento.',
                '- Após cinco dias do vencimento, o boleto estará sujeito à protesto.',
                '- Em caso de dúvidas, entre em contato conosco: contato@guardebem.com',
            ], // máximo de 5
            'aceite' => 0,
            'especieDoc' => 'DS',
        ];

        $boleto = new \Eduardokum\LaravelBoleto\Boleto\Banco\Bradesco($boletoArray);

        return $boleto;
    }

    public function contaBancaria($unidade)
    {
        $contaBancaria = [
            'unidade_id' => $unidade->id,
            'banco_id' => $unidade->contaBancaria->banco_id,
            'agencia' => $unidade->contaBancaria->agencia,
            'agencia_dv' => $unidade->contaBancaria->agencia_dv,
            'conta' => $unidade->contaBancaria->conta,
            'conta_dv' => $unidade->contaBancaria->conta_dv,
            'carteira' => $unidade->contaBancaria->carteira,

        ];

        return $contaBancaria;
    }

    public function gerarRemessa(array $boletos, $beneficiario,$contaBancaria){
        $remessaArray = [
            'agencia'       => $contaBancaria['agencia'],
            'agenciaDv'     => $contaBancaria['agencia_dv'], // se possuir
            'conta'         => $contaBancaria['conta'],
            'contaDv'       => $contaBancaria['conta_dv'], // se possuir
            'carteira'      =>$contaBancaria['carteira'],
            'beneficiario'  => $beneficiario,
        ];

        $remessa = new \Eduardokum\LaravelBoleto\Cnab\Remessa\Cnab400\Banco\Bradesco($remessaArray);

        foreach ($boletos as $boleto)
            $remessa->addBoleto($boleto);

        $file_name = 'CB'. date('dmy') . '.REM';

        $remessa->save(storage_path() . DIRECTORY_SEPARATOR . 'remessas' . DIRECTORY_SEPARATOR . $file_name);
    }



    public function newBoleto($id)
    {
        $conta = ContasAReceber::findOrFail($id);

        $unidade = Unidade::findOrFail($conta->unidade_id);

        $beneficiario = $this->beneficiario($unidade);

        $contaBancaria = $this->contaBancaria($unidade);

        $pagador = $this->pagador($conta->cliente()->get()[0]);

        $boletoGerado = $this->generateBoleto($conta, $pagador, $beneficiario,$contaBancaria);

        return $boletoGerado;
    }
}