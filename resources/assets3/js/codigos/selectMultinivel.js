/**
 * Created by pabliciotjg on 16/08/2017.
 */

component = "";

$(document).ready(function () {

    parentLevel = "";

    id = null;

    getFilhoSelect(teste, parentLevel, id);

    $('.selectMultiniivel').append(component);
});

function getFilhoSelect(array, parentLevel, id) {

    var itemLevel = 1;

    $.each(array, function (key, pai) {

        if(pai.id = id){
            selected = "selected";
        }

        if (parentLevel == "") {
            level = itemLevel;
        } else {
            level = parentLevel + "." + itemLevel;
        }

        if (isset(pai.filho)) {

            component += "<optgroup label='" + level + "   " + pai.nome + "'>";

            getFilhoSelect(pai.filho, level, key);

            component += "</optgroup>";
        }
        else {

            component += "<option value='" + pai.id + "'"+selected+">" + level + " " + pai.nome + "</option>";
        }

        itemLevel++;

    });

}


function isset(variable) {
    return typeof variable !== typeof undefined ? true : false;
}