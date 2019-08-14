/**
 * Created by Lais on 20/08/2017.
 */
$(document).ready(function () {
    $(document).find('.tirar').on('mouseover', function () {

        if($('.vdinheiro').val() == '' || $('.vdinheiro').val() == 'R$ 0,00'){
            $('.pdinheiro').prop('required',false);
            $('.vdinheiro').prop('required',false);


        }else {
            $('.pdinheiro').prop('required',true);
            $('.vdinheiro').prop('required',true);

        }

        if($('.vcartaoCredito').val() == '' || $('.vcartaoCredito').val() == 'R$ 0,00'){
            $('.vcartaoCredito').prop('required',false);
            $('.pcartaoCredito').prop('required',false);
        }else {
            $('.vcartaoCredito').prop('required',true);
            $('.pcartaoCredito').prop('required',true);
        }

        if($('.vcartaoDebito').val() == '' || $('.vcartaoDebito').val() == 'R$ 0,00'){
            $('.vcartaoDebito').prop('required',false);
            $('.pcartaoDebito').prop('required',false);
        }else {
            $('.vcartaoDebito').prop('required',true);
            $('.pcartaoDebito').prop('required',true);
        }

        if($('.vboleto').val() == '' || $('.vboleto').val() == 'R$ 0,00'){
            $('.vboleto').prop('required',false);
            $('.pboleto').prop('required',false);
        }else {
            $('.vboleto').prop('required',true);
            $('.pboleto').prop('required',true);
        }

        if($('.vcheque').val() == '' || $('.vcheque').val() == 'R$ 0,00'){
            $('.vcheque').prop('required',false);
            $('.pcheque').prop('required',false);
        }else {
            $('.vcheque').prop('required',true);
            $('.pcheque').prop('required',true);
        }

        if($('.voutra').val() == '' || $('.voutra').val() == 'R$ 0,00'){
            $('.voutra').prop('required',false);
            $('.poutra').prop('required',false);
        }else {
            $('.voutra').prop('required',true);
            $('.poutra').prop('required',true);
        }
    })
});