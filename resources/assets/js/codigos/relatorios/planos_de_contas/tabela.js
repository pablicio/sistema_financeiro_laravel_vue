/**
 * Created by pabliciotjg on 16/08/2017.
 */

component = "";

$(document).ready(function () {

    parentLevel = "";

    id = null;

    getFilhoTable(teste, parentLevel, id);

    $('.tabelaMultinivel').append(component);

    datatableRelatorio();
});

function getFilhoTable(array, parentLevel, id) {

    var itemLevel = 1;

    $.each(array, function (key, pai) {

        parentLevel == "" ? level = itemLevel : level = parentLevel + "." + itemLevel;

        if (isset(pai.filho)) {

            component += "<tr>" +
                "<td style='font-weight: bold;font-size: 18px;width: 90%;'>" +
                level + "   " + pai.nome +
                "</td>" +
                "<td style='font-weight: bold;font-size: 18px;width: 90%;'>" +
                "R$ " + somaFilhos(pai.filho) +
                "</td>";

            getFilhoTable(pai.filho, level, key);

            component += "</tr>";
        }
        else {

            component += "<tr>" +
                "<td>" + level + "   " + pai.nome + "</td>" +
                "<td>" + "R$ " + parseFloat(pai.valor) + "</td>" +
                "</tr>";
        }

        itemLevel++;

    });

}

//bugado
function somaFilhos(filho) {

    soma = 0;

    $.each(filho, function (key, nino) {

        soma += +nino.valor;
    });

    console.log(soma);

    return parseFloat(soma);

}


function isset(variable) {
    return typeof variable !== typeof undefined ? true : false;
}