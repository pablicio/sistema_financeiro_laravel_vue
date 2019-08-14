<?php
function getFilhoSelect($array, $parentLevel = "", $id = null)
{
    $itemLevel = 1;

    foreach ($array as $pai) {
        $selected = "";

        $level = ($parentLevel == "") ? $itemLevel : $parentLevel . "." . $itemLevel;

        if ($pai['id'] == $id)
            $selected = "selected";

        if (isset($pai['filho'])) {
            echo "<option class='bld' value='{$pai['id']}' $selected>$level {$pai['nome']}";

            getFilhoSelect($pai['filho'], $level, $id);

            echo "</option>";
        } else {
            echo "<option value='{$pai['id']}' $selected>$level {$pai['nome']}</option>";
        }
        $itemLevel++;
    }

}

?>

<style>
    .bld {
        font-weight: bold;
        font-size: 15px;
    }
</style>

<select name="conta_id" class="form-control">
    <option value="">*** SELECIONE A CATEGORIA ***</option>
    <?php getFilhoSelect($array, "", $id_cat ?? null) ?>
</select>
