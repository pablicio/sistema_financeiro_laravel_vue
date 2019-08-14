<?php

function flattenOnlyIds($array) {
    $return = [];
    array_walk_recursive($array, function($a,$array) use (&$return) {
        if($array == "id"){
            $return[] = $a;
        }
    });
    return $return;
}

function getFilhosTable($array, $parente = "", $request)
{
    foreach ($array as $pai) {

        if (count($pai["filhos"])) {

            $valor = \App\Projeto\Financeiro\ContaContabil::valorSomaPais(flattenOnlyIds($pai['filhos']), $request);

            $texto = substr("$parente.{$pai["id"]}&nbsp&nbsp&nbsp&nbsp{$pai["nome"]}",1);

            echo "<tr class='bld'><td>$texto<td>{$valor}</td></tr></td>";

            getFilhosTable($pai["filhos"], $parente . "." . $pai["id"], $request);


        } else {

            $valor = \App\Projeto\Financeiro\ContaContabil::valorSomaPais([$pai["id"]], $request);

            $texto = substr("$parente.{$pai["id"]}&nbsp&nbsp&nbsp&nbsp{$pai["nome"]}",1);

            echo "<td>$texto</td><td>{$valor}</td></tr></td>";
        }
    }
}

?>

<style>
    .bld {
        font-weight: bold;
        font-size: 13px;
        width: 200px;
    }
</style>


<table class="table datatable-export">
    <thead>
    <tr class="bld">
        <th>Categorias</th>
        <th>Total</th>
    </tr>
    </thead>

    <tr class="bld">
        <td>Resultado: Lucro/Prejuízo</td>
        <td> {{"Total"}}</td>
    </tr>
</table>