@extends('template.template')
@section('content')
    <!-- Page header -->
    @include('shared.header', $paramns = [
        'nome' => 'Filtros de Relatórios de Planos de Contas',
        'breadcrum' => [
            [
                'nome' => 'Filtros de Relatórios de Planos de Contas',
                'url'  => ''
            ]
            ]
     ])
    <!-- /page header -->


    <!-- Conteúdo -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <legend class="text-bold">Preencha os campos abaixo</legend>
            {{ Form::open(array('url' => '/relatorios/planos_de_contas/visualizar','class'=>'form-horizontal','method' => 'get')) }}

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


                <button class="btn btn-info alpaca-float-right">Consultar</button>
            {{ Form::close()}}
        </div>

    </div>


@endsection

@push('scripts')

@endpush