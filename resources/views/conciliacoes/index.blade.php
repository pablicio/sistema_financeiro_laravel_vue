@extends('template.template')
@section('content')

    <style>
        .pagination {
            float: right;
        }
    </style>


    <!-- Page header -->
    <div class="header">
        <div class="panel-heading">
            @if (session()->has('data_session'))
                <div class="alert alert-success">

                    <?php $data_session = explode("_", session('data_session')); ?>

                    <input type="hidden" id="id_session" name="id_session" value="{{$data_session[0]}}">

                    <input type="hidden" id="lancamento_id" name="lancamento_id" value="{{$data_session[1]}}">

                    <input type="hidden" id="tipoLancamento" name="tipoLancamento" value="{{$data_session[2]}}">

                    {{"Lançamento gerado com sucesso!"}}
                </div>
            @endif

            @if($errors->count() > 0)
                <div class="alert alert-danger">
                    {{ Html::ul($errors->all()) }}
                </div>
            @endif

            @if($soma >= 0)
                <h1>Saldo Banco: <span class="label label-info">{{$soma}}</span></h1>
            @else
                <h1>Saldo Banco: <span class="label label-warning">{{$soma}}</span></h1>
            @endif
        </div>

        <div class="panel-heading">
            @if($somaSistema >= 0)
                <h1>Saldo Sistema: <span class="label label-info">{{$somaSistema}}</span></h1>
            @else
                <h1>Saldo Sistema: <span class="label label-warning">{{$somaSistema}}</span></h1>
            @endif
        </div>

        <div class="panel-heading">
            <h4>
                <i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Projeto</span> -
                Conciliações
            </h4>
        </div>
        <hr>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="icon-home2 position-left"></i> Principal</a></li>
            <li class="breadcrumb-item active">Conciliações</li>
        </ol>

    </div>
    <!-- /page header -->

    {{--    {{dd($id_div)}}--}}

    <!-- Conteúdo -->
    @foreach($conciliacoes as $chave => $conciliacao)
        {{ Form::open(array('url' => '/conciliacoes/associate','class'=>'form-horizontal')) }}
        <div class="panel">
            <div class="row">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-success" href="">Conciliar</button>
                    <br>
                    <ul class="list list-unstyled">
                        <li>ID#: {{$conciliacao->id}}</li>
                        <li>Valor: {{$conciliacao->valor}}</li>
                        <li>Descrição: {{$conciliacao->memo}}</li>
                        <li>Data: <span class="text-semibold">@date($conciliacao->data_deposito)</span></li>
                    </ul>
                </div>

                <div id="{{'conciliacao_'.$conciliacao->id}}" class="col-sm-6">
                    <a id="{{$conciliacao->id}}" value="{{$conciliacao->valor}}"
                       class="btn btn-outline-primary float-right criarNovo">Novo</a>

                    <a id="{{$conciliacao->id}}" value="{{$conciliacao->valor}}"
                       class="btn btn-outline-warning float-lg-right pesquisar">Pesquisar</a>

                    <input type="hidden" name="conciliacao_id" value="{{$conciliacao->id}}">
                    <input type="hidden" name="tipo" @if($conciliacao->valor >= 0) value="1" @else  value="0" @endif >
                </div>
            </div>
        </div>
        {{ Form::close() }}
    @endforeach

    {!! $conciliacoes->links('vendor.pagination.bootstrap-4') !!}

    <div class="push"></div>
    <div class="push"></div>

    {{ csrf_field() }}
    @include('conciliacoes.pesquisar')
    @include('conciliacoes.novo')


@endsection

@push('scripts')

<script>
    teste = <?php echo $array; ?>;
</script>

{!! Html::script('js/conciliacoes/pesquisar.js')!!}
{!! Html::script('js/conciliacoes/novo.js')!!}
{!! Html::script('js/selectMultinivel.js')!!}


@endpush