@extends('template.template')
@section('content')
    <!-- Page header -->
    @include('shared.header', $paramns = [
        'nome' => 'Importação de OFX',
        'breadcrum' => [
                [
                    'nome' => 'Conciliações',
                    'url'  => '/conciliacoes/'
                ],
                [
                    'nome' => 'Importação de OFX',
                    'url'  => ''
                ]
            ]
         ])
    <!-- /page header -->
    {{ Form::open(array('url' => '/conciliacoes/importa','class'=>'form-horizontal','files'=>true)) }}


    <!-- Mostra Mensagem -->
    @if (Session::has('mensagem'))
        <div class="alert alert-info">{{ Session::get('mensagem') }}</div>
    @endif
    <!-- if there are creation errors, they will show here -->
    @if($errors->count() > 0)
        <div class="alert alert-danger">
            {{ Html::ul($errors->all()) }}
        </div>
    @endif
    <div class="panel panel-flat">
        <div class="panel-body">
            <legend class="text-bold">Preencha os campos abaixo</legend>

            <div class="row">
                <div class="col-md-5">
                    {!! Form::select('banco_id', $conta->pluck("favorecido","id") ,null,['class'=>'select2','placeholder'=>'*** SELECIONE A CONTA ***']) !!}
                </div>
                <div class="col-md-5">
                    <input type="file" class="filestyle" name="doc" data-text="Carregar OFX"
                           data-btnClass="btn-success">
                </div>

            </div>


            <div class="text-right">
                <button type="submit" class="btn btn-primary">Importar
                    <i
                            class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection('content')


