@extends('templates.template')
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Guardebem</span> -
                    Remessas de Boletos</h4>
            </div>
            <div class="heading-elements">

            </div>
        </div>
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
                <li><a href="datatable_styling.html">Datatables</a></li>
                <li class="active">Basic styling</li>
            </ul>
        </div>
    </div>
    <!-- /page header -->
    <!-- Content area -->
    <div class="content">
    {{--{{ Form::open(array('url' => 'admin/cliente_upload','class'=>'form-horizontal','files'=>true)) }}--}}
    <!-- Mostra Mensagem -->
        @if (Session::has('mensagem'))
            <div class="alert alert-info">{{ Session::get('mensagem') }}</div>
        @endif
    <!-- if there are creation errors, they will show here -->
        @if($errors->count() > 0)
            <div class="alert alert-danger">
                {{ HTML::ul($errors->all()) }}
            </div>
        @endif
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Consulta de Remessas</h5>
            </div>
            {!! $html->table() !!}
        </div>
    </div>
@endsection

@push('scripts')
{!! $html->scripts() !!}
@endpush



