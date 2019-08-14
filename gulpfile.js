const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

elixir(function (mix) {

    mix.styles([
        'icomoon.css',
        'bootstrap.css',
        'core.css',
        'components.css',
        'colors.css',
        'acordion.css'
    ], 'public/css/app.css');

    mix.scripts([
        'codigos/pace.min.js',
        'codigos/jquery.min.js',
        'bootstrap.min.js',
        'codigos/blockui.min.js',
        'codigos/uniform.min.js',
        'codigos/moment.min.js',
        'codigos/daterangepicker.js',
        'codigos/script.js',
        'codigos/select2.min.js',
        'codigos/select2.js',
        '../../../node_modules/sweetalert/dist/sweetalert.min.js',
        'codigos/jquery.maskMoney.js',
        'codigos/masks.js',
        'codigos/maskPlugin.js',
        'codigos/switchery.min.js',
        'codigos/switch.min.js',
        'codigos/datatables/datatables.min.js',
        'codigos/datatables/jszip.min.js',
        'codigos/datatables/pdfmake.min.js',
        'codigos/datatables/vfs_fonts.min.js',
        'codigos/datatables/buttons.min.js',
        'codigos/acordion.js',
        'codigos/app.js'

    ], 'public/js/app.js');

    mix.scripts([
        'codigos/pessoas.js',
        'codigos/form_checkboxes_radios.js'
    ], 'public/js/pessoas.js');


    mix.scripts([
        'codigos/contribuintesSwitchery.js'
    ], 'public/js/contribuintesSwitchery.js');


    mix.scripts([
        'codigos/conciliacoes/novo.js',
        'codigos/conciliacoes/pesquisar.js'
    ], 'public/js/conciliacoes.js');

    mix.scripts([
        'codigos/modal/createModal.js',
        'codigos/modal/deleteModal.js',
        'codigos/modal/editModal.js'

    ], 'public/js/modal.js');

    mix.scripts([
        'codigos/orcamentos/calculoOrcamento.js',
        'codigos/orcamentos/tableEditableProdutos.js',
        'codigos/orcamentos/tableEditableServicos.js'

    ], 'public/js/orcamentos.js');


    mix.scripts([
        'codigos/vendas/calculoVenda.js',
        'codigos/vendas/pagamentoCredito.js',
        'codigos/vendas/pagamentoDebito.js',
        'codigos/vendas/tableEditableProdutos.js',
        'codigos/vendas/tableEditableServicos.js',
        'codigos/vendas/validaFormasPagamento.js'

    ], 'public/js/vendas.js');

    mix.webpack('main.js');
});