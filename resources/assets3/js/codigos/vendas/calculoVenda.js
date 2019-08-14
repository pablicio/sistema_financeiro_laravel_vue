$(document).ready(function () {

    function soNumeros(numeros) { //variavel do parametro recebe o caractere digitado//
        return numeros.replace(/\D/g, "");
    }

    function retiraValores(classe) {

        var soma = 0;

        $(document).find(classe).each(function (el, field) {
            soma += +soNumeros(field.value);
        });

        return soma;
    }


    function somarValores(classe) {

        var soma = 0;

        quantidades = [];

        $(document).find('.quantidade').each(function (el, field) {
            quantidades.push(field.value);
        });

        cont = 0;

        $(document).find(classe).each(function (el, field) {
            soma += +soNumeros(field.value) * quantidades[cont];
            cont++;
        });

        return soma;
    }

    $(function () {
        $(document).find('.calcular').on('mouseover', function (e) {

            var total = somarValores('.valorcc');

            desconto = soNumeros($('#desconto').val());

            total -= desconto;

            total /= 100;

            $('#valorFormas').val(total);

            $('#valor').val(total);
        })
    });

    $(function () {
        $(document).find('.tirar').on('mouseover', function (e) {

            var total = retiraValores('.valorTira') / 100;

            retira = $('#valor').val();

            total -= retira;

            $('#valorFormas').val(total);

        })
    });

});