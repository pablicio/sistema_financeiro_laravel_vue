<?php namespace App\Helpers;

use App\Projeto\Financeiro\ContasAReceber;
use App\Support\Convert;

class Pagamentos
{
    public static function contasAReceberCreate($request, $venda)
    {
        $conta = new ContasAReceber();

        $formas = TrataArray::formasPagamento();

        foreach ($request as $key => $tipos) {

            if (in_array($key, $formas) && count($tipos) > 1) {

                $contas_a_receber = array_collapse([$request['venda'], $tipos, ['venda_id' => $venda]]);

                !empty($contas_a_receber['total_parcelas']) ? $parcelas = $contas_a_receber['total_parcelas'] : $parcelas = 1;

                $contas_a_receber['valor'] = Convert::moneyToDecimal($contas_a_receber['valor']) / $parcelas;

                for ($parcela = 1; $parcela <= $parcelas; $parcela++) {

                    $teste = array_merge($contas_a_receber, ['parcela' => $parcela]);

                    $conta = $conta->create($teste);

                    self::createAfterPgto($conta);
                }
            }

        }

    }

    public static function contasAReceberUpdate($request, $venda)
    {
        $formas = TrataArray::formasPagamento();

        foreach ($request as $key => $tipos) {

            if (in_array($key, $formas) && count($tipos) > 1) {

                $contas_a_receber = array_collapse([$request['venda'], $tipos, ['venda_id' => $venda]]);

                !empty($contas_a_receber['total_parcelas']) ? $parcelas = $contas_a_receber['total_parcelas'] : $parcelas = 1;

                $contas_a_receber['valor'] = Convert::moneyToDecimal($contas_a_receber['valor']) / $parcelas;

                for ($parcela = 1; $parcela <= $parcelas; $parcela++) {

                    $teste = array_merge($contas_a_receber, ['parcela' => $parcela]);

                    $contas_a_receber = ContasAReceber::findOrFail($teste['id'])->update($teste);

                    self::createAfterPgto($contas_a_receber);
                }
            }

        }

    }

    public static function createAfterPgto($conta)
    {
        $conta->contaContabilValor()
            ->updateOrCreate(
                [
                    'conta_receber_id' => $conta->id
                ],
                [
                    'valor' => $conta->valor,
                    'conta_id' => $conta->conta_id,
                    'data_pagamento' => $conta->data_pagamento
                ]);
    }


}