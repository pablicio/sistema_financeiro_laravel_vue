<?php


function getFilhosTable($array, $parentLevel = "")
{
    $itemLevel = 1;

    foreach ($array as $conta) {
        $level = ($parentLevel == "") ? $itemLevel : $parentLevel . "." . $itemLevel;

        if (isset($conta['filho'])) {

            echo "<tr><td><strong>$level&nbsp;&nbsp;&nbsp;&nbsp;{$conta["nome"]}</strong>";
            returnAcoesPai($conta["id"]);
            echo "</td></tr>";

            getFilhosTable($conta['filho'], $level);


        } else {
            echo "<td>$level&nbsp;&nbsp;&nbsp;&nbsp;{$conta["nome"]}</td>";
            returnAcoesFilho($conta["id"]);
            echo "</tr>";
        }
        $itemLevel++;
    }
}


function returnAcoesFilho($id)
{
    echo "<td class='text-center'>
                <ul class='nav navbar-nav navbar-right'>
                    <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                        <i class='icon-menu9'></i>
                        </a>
                        <ul class='dropdown-menu dropdown-menu-right'>
                            <li>
                                <a href='/conta_contabil/$id/edit'><i class='icon-pencil5'></i> Editar Conta</a>
                            </li>
                             <li>
                                <a href='/conta_contabil/$id/delete'><i class='icon-close2'></i> Deletar Conta</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </td>";
}

function returnAcoesPai($id)
{
    echo "<td class='text-center'>
    <ul class='nav navbar-nav navbar-right'>
        <li class='dropdown'>
            <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                <i class='icon-menu9'></i>
            </a>
            <ul class='dropdown-menu dropdown-menu-right'>
                <li>
                    <a href='/conta_contabil/$id/edit'><i class='icon-pencil5'></i> Editar Conta</a>
                </li>

            </ul>
        </li>
    </ul>
</td>";
}

?>

<table class="table datatable-export">
    <thead>
    <tr>
        <th>Categorias</th>
        <th class="text-center">Ações</th>
    </tr>
    </thead>
    <tbody>
    <?php getFilhosTable($array, ''); ?>
    </tbody>
</table>





