$(document).ready(function(){

    $('.money').maskMoney({prefix:'R$ ', thousands:'.',decimal:','});

    $(document).find('.calcular').on('mouseover', function (e) {
        $('.money').maskMoney({prefix:'R$ ', thousands:'.',decimal:','});
    });

    $(document).find('.tirar').on('mouseover', function (e) {
        $('.money').maskMoney({prefix:'R$ ', thousands:'.',decimal:','});

    });

    $(".date").mask("99/99/9999");

    $('.fone').mask('(99) 9999-99999');
    $('.fone').blur(function(event) {
        if($(this).val().length == 15){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
            $('.fone').mask('(99) 99999-9999');
        } else {
            $('.fone').mask('(99) 9999-99999');
        }
    });
    
    $('.cpf').mask('999.999.999-99');

    $('.cep').mask('99999-999');

    $('.cnpj').mask('99.999.999/9999-99');
    
});

$(function() {
    $(document).on('focus', 'selecionavel', function() {
        this.select();
    });
});