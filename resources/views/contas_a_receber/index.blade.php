@extends('templates.template')
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Guardebem</span> -
                    Listagem de Clientes</h4>
            </div>

            <div class="heading-elements">
                <div class="heading-btn-group">
                    <a href="{{ URL::to('admin/clientes/create') }}" class="btn btn-link btn-float has-text"><i
                                class="icon-add text-primary"></i><span>Adicionar Cliente</span></a>
                </div>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="/"><i class="icon-home2 position-left"></i> Principal</a></li>
                <li class="active"><a href="/admin/clientes">Listagem de Clientes</a></li>
            </ul>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Listagem de Clientes</h5>
            </div>
            {!! $html->table() !!}
        </div>

    </div>
    <!-- /content area -->
@endsection

@push('scripts')
{!! $html->scripts() !!}
@endpush



