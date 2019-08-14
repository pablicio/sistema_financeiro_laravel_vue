@extends('template.template')
@section('content')


    <!-- Page header -->
    @include('shared.header', $paramns = [
        'nome' => 'Contas Contábeis',
        'url' => '/contas_contabeis/create',
        'breadcrum' => [
            [
                'nome' => 'Contas Contábeis',
                'url'  => ''
            ]
            ]
        ])
    <!-- /page header -->

    <!-- if there are creation errors, they will show here -->
    @if($errors->count() > 0)
        <div class="alert alert-danger">
            {{ Html::ul($errors->all()) }}
        </div>
    @endif

    <div class="panel">
    <!-- Conteúdo -->
{{--    @include('contas_contabeis.tabela',['array' => $array])--}}
    </div>
@endsection

