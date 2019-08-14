@extends('template.template')
@section('content')
    <!-- Page header -->
    @include('shared.header', $paramns = [
        'nome' => 'Filtros de Relatórios de Contas a Pagar',
        'breadcrum' => [
            [
                'nome' => 'Filtros de Relatórios de Contas a Pagar',
                'url'  => ''
            ]
            ]
     ])
    <!-- /page header -->


    <!-- Conteúdo -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <legend class="text-bold">Preencha os campos abaixo</legend>
            {{ Form::open(array('url' => '/relatorios/contas_a_pagar/visualizar','class'=>'form-horizontal','method' => 'get')) }}

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="fornecedor_id" class="control-label">Fornecedor</label>
                        {!! Form::select('fornecedor_id', $fornecedores,'',
                        ['id' => 'fornecedor_id','class'=>'select2 form-control-danger',
                        'placeholder'=>'Selecione o Fornecedor'
                        ,'data-error' => 'Informe o fornecedor.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="situacao_id" class="control-label">Situação</label>
                        {!! Form::select('situacao_id', $situacoes, '',
                        ['id' => 'situacao_id','class'=>'select2 form-control-danger',
                        'placeholder'=>'Selecione a Situação'
                        ,'data-error' => 'escolha a situação.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="tipo_pagamento_id" class="control-label">Tipo de Pagamento</label>
                        {!! Form::select('tipo_pagamento_id', $tipos_pagamentos,'',
                        ['id' => 'tipo_pagamento_id','class'=>'select2 pgto form-control-danger',
                        'placeholder'=>'Selecione o Tipo de Pagamento'
                        ,'data-error' => 'Informe o tipo de pagamento.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="sub_tipo_pagamento_id" class="control-label">Sub Tipo de Pagamento</label>
                        {!! Form::select('sub_tipo_pagamento_id', [],'',
                        ['id' => 'sub_tipo_pagamento_id','class'=>'select2 subpgto form-control-danger',
                        'placeholder'=>'Selecione o sub tipo de Pagamento'
                        ,'data-error' => 'Informe o sub tipo de pagamento.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4">
                    <label class="control-label">Data de Cadastro Inicial</label>

                    {!! Form::input('text','data_nascimento[date][]',null,
                    ['class'=>'form-control date','placeholder'=>'Data Cadastro Inicial']) !!}

                </div>
                <div class="col-lg-4">
                    <label class="control-label">Data de Cadastro Final</label>

                    {!! Form::input('text','data_nascimento[date][]',null,
                    ['class'=>'form-control date','placeholder'=>'Data Cadastro Final']) !!}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4">
                    <label class="control-label">Data de Vencimento Inicial</label>

                    {!! Form::input('text','data_vencimento[date][]',null,
                    ['class'=>'form-control date','placeholder'=>'Data Vencimento Inicial']) !!}

                </div>
                <div class="col-lg-4">
                    <label class="control-label">Data de Vencimento Final</label>

                    {!! Form::input('text','data_vencimento[date][]',null,
                    ['class'=>'form-control date','placeholder'=>'Data Vencimento Final']) !!}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4">
                    <label class="control-label">Data de Pagamento Inicial</label>

                    {!! Form::input('text','data_pagamento[date][]',null,
                    ['class'=>'form-control date','placeholder'=>'Data Pagamento Inicial']) !!}

                </div>
                <div class="col-lg-4">
                    <label class="control-label">Data de Pagamento Final</label>

                    {!! Form::input('text','data_pagamento[date][]',null,
                    ['class'=>'form-control date','placeholder'=>'Data Pagamento Final']) !!}
                </div>
            </div>


            <button class="btn btn-info alpaca-float-right">Consultar</button>

            {{ Form::close()}}
        </div>

    </div>


@endsection

