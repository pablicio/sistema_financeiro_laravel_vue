<?php

Route::get('/home', 'HomeController@index');

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'relatorios'], function () {

    //Relatórios de Clientes
    Route::get('relatorios_clientes', 'Relatorios\ClienteRelatorioController@index');
    Route::get('relatorios_clientes/visualizar', 'Relatorios\ClienteRelatorioController@view');

    //Relatórios de Produtos
    Route::get('relatorios_produtos', 'Relatorios\ProdutoRelatorioController@index');
    Route::get('relatorios_produtos/visualizar', 'Relatorios\ProdutoRelatorioController@view');

    //Relatórios de Serviços
    Route::get('relatorios_servicos', 'Relatorios\ServicoRelatorioController@index');
    Route::get('relatorios_servicos/visualizar', 'Relatorios\ServicoRelatorioController@view');

    //Relatórios de Reservas de  Contas A Pagar
    Route::get('contas_a_pagar', 'Relatorios\ContasAPagarRelatorioController@index');
    Route::get('contas_a_pagar/visualizar', 'Relatorios\ContasAPagarRelatorioController@view');

    //Relatórios de Reservas de Contas A Receber
    Route::get('contas_a_receber', 'Relatorios\ContaAReceberRelatorioController@index');
    Route::get('contas_a_receber/visualizar', 'Relatorios\ContaAReceberRelatorioController@view');

    //Relatórios de Categorias DRE
    Route::get('relatorios_dre', 'Relatorios\DRERelatorioController@index');
    Route::get('relatorios_dre/visualizar', 'Relatorios\DRERelatorioController@view');

    //Relatórios de Planos de Contas
    Route::get('planos_de_contas', 'Relatorios\PlanoDeContaRelatorioController@index');
    Route::get('planos_de_contas/visualizar', 'Relatorios\PlanoDeContaRelatorioController@view');
});



Route::group(['prefix'=>'painel'],function (){
    //PermissionController
    Route::resource('/permissions', 'Painel\PermissionController');
    Route::get('/permissions/{id}/roles', 'Painel\PermissionController@roles');

    //RoleController
    Route::resource('/roles', 'Painel\RoleController');
    Route::get('/roles/{id}/permissions', 'Painel\RoleController@permissions');

    //UserController
    Route::resource('/users', 'Painel\UserController');
    Route::get('/users/{id}/roles', 'Painel\UserController@roles');

    //PermissionRoleController
    Route::get('/permission_roles/create', 'Painel\PermissionRoleController@create');
    Route::post('{permission_role_id}', 'Painel\PermissionRoleController@store');

    //PermissionUserController
    Route::get('/permission_users/edit/{id}', 'Painel\PermissionUserController@edit');
    Route::put('/permission_users/edit/{id}', 'Painel\PermissionUserController@update');

});


Route::resource('funcionarios', 'FuncionarioController');
Route::get('funcionarios/{id}/delete', 'FuncionarioController@delete');

Route::resource('clientes', 'ClienteController');
Route::get('clientes/{id}/delete', 'ClienteController@delete');
Route::get('clientes/{id}/produtos', 'ClienteController@produtos');
Route::get('clientes/{id}/servicos', 'ClienteController@servicos');
Route::get('clientes/{id}/vendas', 'ClienteController@vendas');


//ORÇAMENTOS
Route::get('orcamentos/{id}/clienteOrcamentos', 'OrcamentoController@clienteOrcamentos');
Route::get('orcamentos/{id}/create', 'OrcamentoController@create');
Route::post('orcamentos/{id}', 'OrcamentoController@store');
Route::get('orcamentos/{id}/edit', 'OrcamentoController@edit');
Route::put('orcamentos/{id}', 'OrcamentoController@update')->name('orcamentos.update');
Route::get('orcamentos/{id}/delete', 'OrcamentoController@delete');
Route::get('orcamentos/{id}/show', 'OrcamentoController@show');
Route::get('orcamentos/{id}/envioOrcamento', 'OrcamentoController@envioOrcamento');
Route::get('orcamentos/{id}/printOrcamento', 'OrcamentoController@printOrcamento');
Route::get('/getData', 'OrcamentoController@getData');
Route::get('/getFormasPgto', 'OrcamentoController@getFormasPgto');

Route::get('orcamentos/deleteItem', 'OrcamentoItemController@deleteItem' );


//VENDAS
Route::get('vendas/{id}/clienteVendas', 'VendaController@clienteVendas');
Route::get('vendas/{id}/create', 'VendaController@create');
Route::post('vendas/{id}', 'VendaController@store');
Route::get('vendas/{id}/edit', 'VendaController@edit');
Route::put('vendas/{id}', 'VendaController@update')->name('vendas.update');
Route::get('vendas/{id}/delete', 'VendaController@delete');
Route::get('vendas/{id}/show', 'VendaController@show');
Route::get('vendas/{id}/envioVenda', 'VendaController@envioVenda');
Route::get('vendas/{id}/printVenda', 'VendaController@printVenda');
Route::get('/getData', 'VendaController@getData');
Route::get('/getFormasPgto', 'VendaController@getFormasPgto');
Route::get('vendas/deleteItem', 'InvoiceController@deleteItem' );

//CONTAS A PAGAR
Route::resource('contas_a_pagar', 'ContasAPagarController');
Route::get('contas_a_pagar/{id}/delete', 'ContasAPagarController@delete' );

// ROTAS PARA CONTAS A RECEBER
Route::group(['prefix' => 'contas_a_receber'], function () {
    Route::get('create', 'ContasAReceberController@create');
    Route::post('store', 'ContasAReceberController@store');

});


//CONTAS CONTÁBEIS
Route::resource('contas_contabeis', 'ContaContabilController');
Route::get('contas_contabeis/{id}/delete', 'ContaContabilController@delete');
Route::get('arrayEstruturado', 'ContaContabilController@arrayEstruturado');


//CONTAS BANCÁRIAS
Route::resource('contas_bancarias', 'ContaBancariaController');
Route::get('contas_bancarias/{id}/delete', 'ContaBancariaController@delete');

//CONTAS BANCÁRIAS
Route::resource('tipos_despesas', 'TiposDespesaController');
Route::get('tipos_despesas/{id}/delete', 'TiposDespesaController@delete');
Route::get('/getTiposDespesas', 'TiposDespesaController@getTiposDespesas');

// ROTAS PARA  CONCILIAÇÕES BANCÁRIAS
Route::group(['prefix' => 'conciliacoes'], function () {
    Route::get('', 'ConciliacaoBancariaController@index');
    Route::get('conciliacoes', 'ConciliacaoBancariaController@conciliacoes');
    Route::post('associate', 'ConciliacaoBancariaController@associate');
    Route::get('create/{id}', 'ConciliacaoBancariaController@create')->name("conciliacoes.create");
    Route::get('import_ofx', 'ConciliacaoBancariaController@import_ofx');
    Route::get('{conciliacoes_bancaria}/edit', 'ConciliacaoBancariaController@edit');
    Route::put('{conciliacoes_bancaria}', 'ConciliacaoBancariaController@update');
    Route::post('importa', 'ConciliacaoBancariaController@store');
    Route::get('filter', 'ConciliacaoBancariaController@filter');
    Route::get('/{id}/delete', 'ConciliacaoBancariaController@delete');
    Route::get('ofx/{id}/list', 'ConciliacaoBancariaController@ofxList')->name("conciliacoes.ofx.list");

});


Route::post ( '/conciliacoes/lancadosPagamentoSelected', 'ConciliacaoLancamentoController@lancadosPagamentoSelected');

Route::post ( '/conciliacoes/lancadosRecebimentoSelected', 'ConciliacaoLancamentoController@lancadosRecebimentoSelected');

Route::get ( '/conciliacoes/lancadosPagamento', 'ConciliacaoLancamentoController@lancadosPagamento');

Route::get ( '/conciliacoes/lancadosRecebimento', 'ConciliacaoLancamentoController@lancadosRecebimento');




Route::post ( '/addItem', 'HomeController@addItem' );
Route::get ( '/readItems', 'HomeController@readItems' );
Route::post ( '/editItem', 'HomeController@editItem' );
//Route::post ( '/deleteItem', 'HomeController@deleteItem' );




Route::resource('produtos', 'ProdutoController');
Route::get('produtos/{id}/delete', 'ProdutoController@delete');

Route::resource('servicos', 'ServicoController');
Route::get('servicos/{id}/delete', 'ServicoController@delete');

Route::resource('fornecedores', 'FornecedorController');
Route::get('fornecedores/{id}/delete', 'FornecedorController@delete');
Route::get('getFornecedores', 'FornecedorController@getFornecedores');



Route::resource('centros_de_custo', 'CentrosDeCustoController');
Route::get('centros_de_custo/{id}/delete', 'CentrosDeCustoController@delete');
Route::get('getCentrosDeCusto', 'CentrosDeCustoController@getCentrosDeCusto');


Route::get('getTiposPagamentos', 'TipoPagamentoController@getTiposPagamentos');
Route::get('getSubTiposPagamentos/{id}', 'TipoPagamentoController@getSubTiposPagamentos');




Route::get('/get-cidades/{id}', function ($id) {
    return \App\Projeto\Sistema\Cidade::where('estado_id', $id)->get();
});


//// ROTA DE SELECT DE SUB TIPOS DE PAGAMENTOS
//Route::get('/get-sub_tipos_pagamento/{id}', function ($id) {
//    return \App\Projeto\Variaveis\SubTipoPagamento::where('tipo_pagamento_id', $id)->get();
//});


Route::auth();
