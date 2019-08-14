$(document).ready(function () {

    function soNumeros(numeros) { //variavel do parametro recebe o caractere digitado//
        return numeros.replace(/\D/g, "");
    }

    function somarValores(classe) {

        var soma = 0;

        quantidades = [];

        $(document).find('.quantidade').each(function (el, field) {
            quantidades.push(field.value);
        });

        console.log(quantidades);

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
});