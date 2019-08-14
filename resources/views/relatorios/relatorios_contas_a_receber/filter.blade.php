@extends('template.template')
@section('content')

    <!-- Page header -->
    @include('shared.header', $paramns = [
        'nome' => 'Filtros de Relatórios de Contas a Receber',
        'breadcrum' => [
            [
                'nome' => 'Filtros de Relatórios de Contas a Receber',
                'url'  => ''
            ]
            ]
     ])
    <!-- /page header -->


    <!-- Conteúdo -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <legend class="text-bold">Preencha os campos abaixo</legend>
            {{ Form::open(array('url' => '/relatorios/contas_a_receber/visualizar','class'=>'form-horizontal','method' => 'get')) }}
            <div class="form-group row">
                <div class="col-lg-4">

                </div>
            </div>

            <div class="row">
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
                        <label for="cliente_id" class="control-label">Clientes</label>
                        {!! Form::select('cliente_id', $clientes, '',
                        ['id' => 'cliente_id','class'=>'select2 form-control-danger',
                        'placeholder'=>'Selecione o Cliente'
                        ,'data-error' => 'escolha o cliente.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="forma_de_pagamento_id" class="control-label">Formas de Pagamento</label>
                        {!! Form::select('forma_de_pagamento_id', $formas_de_pagamento,'',
                        ['id' => 'forma_de_pagamento_id','class'=>'select2 form-control-danger',
                        'placeholder'=>'Formas de Pagamento'
                        ,'data-error' => 'escolha a forma de pagamento.']) !!}
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

