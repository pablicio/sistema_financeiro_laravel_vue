<?php
/**
 * Created by PhpStorm.
 * User: pabliciotjg
 * Date: 22/08/2017
 * Time: 08:02
 */

namespace App\Helpers;


use App\Projeto\Financeiro\ContaContabil;

class EstruturaArray
{
    /**
     * Função - Imprimir um array estruturado
     */

    function imprimirPlanoDeContasEstruturado($planoDeContasEstruturado, $parentLevel = "")
    {
        echo "<ul>";
        $itemLevel = 1;
        foreach ($planoDeContasEstruturado as $conta) {
            $level = ($parentLevel == "") ? $itemLevel : $parentLevel . "." . $itemLevel;
            echo sprintf("<li>%s - %s</li>", $level, $conta['nome']);
            if (isset($conta['filho'])) {
                self::imprimirPlanoDeContasEstruturado($conta['filho'], $level);
            }

            $itemLevel++;
        }
        echo '</ul>';
    }




    /**
     * Função - Estruturar o plano de conta pai e filho
     */
    public static function estruturarPlanoDeContas($planoDeContas, $idPai = null)
    {
        $planoEstruturado = [];

        foreach ($planoDeContas as $conta) {

            if ($conta->conta_id == $idPai) {

                $planoEstruturado[$conta->id] = $conta;

                $child = self::estruturarPlanoDeContas($planoDeContas, $conta->id);

                if ($child)

                    $planoEstruturado[$conta->id]->filho = $child;
            }
        }

        return $planoEstruturado;
    }

}