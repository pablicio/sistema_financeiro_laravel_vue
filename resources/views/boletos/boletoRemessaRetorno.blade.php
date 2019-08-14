@extends('templates.template')
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Guardebem</span> -
                    Importar Retorno</h4>
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
    {{ Form::open(array('url' => 'admin/retorno_remessa/importa','class'=>'form-horizontal','files'=>true)) }}
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
        <div class="panel-body">
            <legend class="text-bold">Preencha os campos abaixo</legend>
            <div class="form-group">
                <label class="control-label col-lg-2">Arquivo Retorno</label>

                <div class="col-lg-4">
                    {!! Form::file('doc') !!}
                </div>
            </div>
            <input type="hidden" name="unidade_id" value="{{Auth::user()->unidade_id}}"><br><br>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Importar <i
                            class="icon-arrow-right14 position-right"></i></button>
            </div>
            {{ Form::close() }}

        </div>

        <div class="panel-heading">
            <h5 class="panel-title">Consulta de Retornos</h5>
        </div>
        {!! $html->table() !!}
    </div>
    </div>
@endsection

@push('scripts')
{!! $html->scripts() !!}
@endpush
