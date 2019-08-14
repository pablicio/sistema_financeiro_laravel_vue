<?php namespace App\Helpers;

use App\Projeto\Financeiro\OrcamentoRecebimento;
use App\Support\Convert;

class PagamentoOrcamento
{
    public static function contasAReceberCreate($request, $orcamento)
    {
        $conta = new OrcamentoRecebimento();

        $formas = TrataArray::formasPagamento();

        foreach ($request as $key => $tipos) {

            if (in_array($key, $formas) && count($tipos) > 1) {

                $recebimento = array_collapse([$request['orcamento'], $tipos, ['orcamento_id' => $orcamento]]);

                !empty($recebimento['total_parcelas']) ? $parcelas = $recebimento['total_parcelas'] : $parcelas = 1;

                $recebimento['valor'] = Convert::moneyToDecimal($recebimento['valor']) / $parcelas;

                for ($parcela = 1; $parcela <= $parcelas; $parcela++) {

                    $teste = array_merge($recebimento, ['parcela' => $parcela]);

                    $conta = $conta->create($teste);
                }
            }

        }

    }

}