@extends('template.template')
@section('content')
    <!-- Page header -->
    @include('shared.header', $paramns = [
        'nome' => 'Relatórios de Produtos',
        'breadcrum' => [
            [
                'nome' => 'Relatórios de Produtos',
                'url'  => ''
            ]
            ]
     ])
    <!-- /page header -->

    <!-- Conteúdo -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <legend class="text-bold">Preencha os campos abaixo</legend>
        <div class="content table-responsive table-full-width">
            {!! $html->table() !!}
        </div>
    </div>
@endsection

@push('scripts')
{!! $html->scripts() !!}
@endpush
