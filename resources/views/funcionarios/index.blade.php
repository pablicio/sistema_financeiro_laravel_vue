@extends('template.template')
@section('content')
    <!-- Page header -->
    @include('shared.header', $paramns = [
        'nome' => 'Funcionários',
        'url' => '/funcionarios/create',
        'breadcrum' => [
            [
                'nome' => 'Funcionários',
                'url'  => '/funcionarios'
            ]
            ]
     ])
    <!-- /page header -->

    <!-- Conteúdo -->
    <div class="panel">
        <div class="content table-responsive table-full-width">
            {!! $html->table() !!}

        </div>
    </div>
@endsection

@push('scripts')
{{--{!! $html->scripts() !!}--}}
@endpush

