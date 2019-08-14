@extends('template.template')
@section('content')
    <!-- Page header -->
    @include('shared.header', $paramns = [
        'btnNome' => 'Importar Ofx',
        'nome' => 'Conciliações Bancárias',
        'url' => '/conciliacoes/import_ofx',
        'breadcrum' => [
            [
                'nome' => 'Conciliações Bancárias',
                'url'  => '/conciliacoes/filter'
            ]
            ]
     ])
    <!-- /page header -->


    <!-- Conteúdo -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <legend class="text-bold">Preencha os campos abaixo</legend>

            {{ Form::open(array('url' => '/conciliacoes/conciliacoes','class'=>'form-horizontal','method' => 'get')) }}
            <div class="form-group row">
                <div class="col-lg-4">
                    <label class="control-label col-lg-4">Conta Bancária</label>
                    {!! Form::select('conta_bancaria_id[int]', $conta->pluck("favorecido","id") ,null,['class' => 'select2', 'placeholder'=>'*** SELECIONE A CONTA ***']) !!}
                </div>
            </div>


            <div class="form-group row">
                <div class="col-lg-5">
                    <label class=" col-lg-9">Data de Vencimento</label>

                    <input type="text" name="data_deposito[date][]" value="" class="form-control date"
                           placeholder="Data de Vencimento">
                </div>
                <div class="col-lg-5">
                    <label class="col-lg-9">Data de Pagamento</label>

                    <input type="text" name="data_deposito[date][]" value="" class="form-control date"
                           placeholder="Data de Pagamento">
                </div>


            </div>


            <button class="btn btn-info float-lg-right">Consultar</button>
            {{ Form::close()}}

        </div>
    </div>
@endsection

