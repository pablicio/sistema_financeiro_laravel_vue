<?php

function make_list($array)
{
    $monta = "<ul>";

    foreach ($array as $item) {

        if (!empty($item['filhos'])) {

            //Pai com filhos

            $monta .= "<li>" . $item['nome'];

            $monta .= make_list($item['filhos']);

            $monta .= "</li>";

        } else {

            //Pai sem filhos

            $monta .= "<li>" . $item['nome'] . "</li>";
        }
    }

    $monta .= "</ul>";

    return $monta;
}

?>


<div class="col-lg-4">
    <style>
        .bld {
            font-weight: bold;
            font-size: 13px;
        }
    </style>
    <?php echo make_list($array); ?>
</div>

