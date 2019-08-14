@extends('template.template')
@section('content')
    <!-- Page header -->
    <div class="header">
        <div class="heading-elements" style="text-align: right">

        </div>

        <div class="panel-heading">
            <h4>
                <i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Projeto</span> -
                Filtros de Relatórios de Clientes
            </h4>
        </div>
        <hr>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="icon-home2 position-left"></i> Principal</a></li>
            <li class="breadcrumb-item active">Filtros de Relatórios de Clientes</li>
        </ol>

    </div>
    <!-- /page header -->


    <!-- Conteúdo -->
    <div class="panel">
        {{ Form::open(array('url' => '/relatorios/relatorios_clientes/visualizar','class'=>'form-horizontal','method' => 'get')) }}
        <div class="form-group row">
            <div class="col-lg-4">

            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-4">
                <label class="control-label col-lg-9">Data de Cadastro Inicial</label>

                {!! Form::input('text','data_nascimento[date][]',null,
                ['class'=>'form-control date','placeholder'=>'Data Cadastro Inicial']) !!}

            </div>
            <div class="col-lg-4">
                <label class="control-label col-lg-9">Data de Cadastro Final</label>

                {!! Form::input('text','data_nascimento[date][]',null,
                ['class'=>'form-control date','placeholder'=>'Data Cadastro Final']) !!}
            </div>
        </div>


        <div class="panel">  <button class="btn btn-info float-lg-right">Consultar</button></div>
        {{ Form::close()}}
    </div>




@endsection

