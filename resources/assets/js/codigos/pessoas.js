/**
 * Created by pabliciotjg on 16/08/2017.
 */
var changePessoas = document.querySelector('.pessoas');

changePessoas.onchange = function () {

    var fisica = changePessoas.checked;

    JuridicaFisica(fisica);

};

$(document).ready(function () {

    if($('#cnpj').val() == ''){
        fisica = true;
    }else{
        fisica = false;
    }

    JuridicaFisica(fisica);
});

function JuridicaFisica(fisica) {
    if (fisica) {
        $('#fisica').show();
        $('#juridica').hide();
        $('#nome').prop('required',true);
        $('#rg').prop('required',true);
        $('#cpf').prop('required',true);
        $('#data_nascimento').prop('required',true);
        $('#razao_social').prop('required',false);
        $('#cnpj').prop('required',false);
    }
    else {
        $('#fisica').hide();
        $('#juridica').show();
        $('#nome').prop('required',false);
        $('#rg').prop('required',false);
        $('#cpf').prop('required',false);
        $('#data_nascimento').prop('required',false);
        $('#razao_social').prop('required',true);
        $('#cnpj').prop('required',true);
    }
}

