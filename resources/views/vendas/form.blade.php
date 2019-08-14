@extends('template.template')
@section('content')
    <!-- Page header -->

    <?php isset($venda) ?

        $paramns = [
            'nome' => 'Atualização de Vendas',
            'breadcrum' => [
                [
                    'nome' => 'Clientes',
                    'url' => '/clientes'
                ],
                [
                    'nome' => 'Vendas de ' . $venda->cliente->present,
                    'url' => '/vendas/' . $venda->cliente->id . '/clienteVendas'
                ],
                [
                    'nome' => 'Atualização de Vendas',
                    'url' => ''
                ]
            ]
        ] :

        $paramns = [
            'nome' => 'Cadastro de Clientes',
            'breadcrum' => [
                [
                    'nome' => 'Clientes',
                    'url' => '/clientes'
                ],
                [
                    'nome' => 'Vendas de ' . $cliente->present,
                    'url' => '/vendas/' . $cliente->id . '/clienteVendas'
                ],
                [
                    'nome' => 'Nova Venda',
                    'url' => ''
                ]
            ]
        ]?>

    @include('shared.header',$paramns)
    <!-- /page header -->



    <!-- Form horizontal -->
    @if(isset($venda))
        {{ Form::model($venda, array('route' => array('vendas.update', $venda->id),
        'class'=>'form-horizontal', 'method' => 'PUT',
        'id' => 'formExemplo','data-toggle' => 'validator', 'role' => 'form')) }}
    @else
        {{ Form::open(array('url' => '/vendas/'.$id,'class'=>'form-horizontal',
        'id' => 'formExemplo','data-toggle' => 'validator', 'role' => 'form')) }}
    @endif



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
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="descricao" class="control-label">Descricao</label>

                        <textarea id="descricao" required type="text" rows="4" cols="4"
                                  class="form-control" name="venda[descricao]" data-error="preencha a descrição"
                                  placeholder="ex: Prezado cliente, segue o descritivo refente a sua solicitação"
                        >{{isset($venda)? $venda->descricao : ''}}</textarea>

                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            <legend class="text-bold"></legend>

            @if(!isset($venda))
                @include('vendas.tabelaProdutos')
                @include('vendas.tabelaServicos')
                <input type="hidden" name="cliente_id" value="{{ $id }}">
                <input type="hidden" name="venda[cliente_id]" value="{{ $id }}">
            @else
                @include('vendas.tabelaProdutosEdit')
                @include('vendas.tabelaServicosEdit')
                <input type="hidden" name="cliente_id" value="{{ $venda->cliente_id }}">
                <input type="hidden" name="venda[cliente_id]" value="{{ $venda->cliente_id  }}">
            @endif


            <legend class="text-bold">Dados da venda</legend>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="funcionario_id" class="control-label">Vendedor</label>
                        {!! Form::select('venda[funcionario_id]',
                          $load['funcionarios'],isset($venda)? $venda->funcionarios->id:'',
                          ['id' => 'funcionario_id','required','class'=>'form-control estados',
                          'placeholder'=>'*** Vendedor Responsável ***','data-error' => 'Informe o vendedor.']) !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="data_venda" class="control-label">Data da Venda</label>
                        <input required id="data_venda" class="form-control date" @if(isset($venda))
                        value="@date($venda->data_venda)" @else value="" @endif
                               name="venda[data_venda]" placeholder="Data da Venda"
                               data-error="Informe a data da venda">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="previsao_entrega" class="control-label">Previsão de Entrga</label>
                        <input required id="previsao_entrega" class="form-control date"
                               @if(isset($venda)) value="{{$venda->previsao_entrega}}"
                               @else value="" @endif name="venda[previsao_entrega]"
                               placeholder="Previsão de Entrega" data-error="Informe a previsão de entrega">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <label for="conta_id" class="control-label">Categorias Contábeis</label>
                    <div class="form-group">
                        <?php
                        isset($venda) ? $id_cat = $venda->conta_id : $id_cat = null;
                        $name = "venda[conta_id]";
                        ?>

                        @include('shared.selectSearch',compact('array','id_cat','name'))

                    </div>
                </div>
            </div>


            <legend class="text-bold">Formas de pagamento</legend>

            <div class="form-group tirar">
                <label class="control-label col-lg-2"></label>

                <div class="col-lg-12">
                    <div class="panel-body">


                        <ul class="nav nav-tabs flex-column flex-md-row" role="tablist">
                            <li class="nav-item"><a class="nav-link  active" href="#tab1" data-toggle="tab" role="tab">Dinheiro</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#tab2" data-toggle="tab" role="tab">Cartão
                                    de Crédito</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab3" data-toggle="tab" role="tab">Cartão
                                    de Débito</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab4" data-toggle="tab"
                                                    role="tab">Boleto</a>
                            </li>
                            {{--<li  class="nav-item"><a  class="nav-link" href="#tab5" data-toggle="tab" role="tab">Transferência Bancária</a></li>--}}
                            <li class="nav-item"><a class="nav-link" href="#tab6" data-toggle="tab"
                                                    role="tab">Cheque</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#tab7" data-toggle="tab" role="tab">+</a>
                            </li>

                        </ul>

                        @if(isset($venda))
                            @include('vendas.formaPagamentoEdit')
                        @else
                            @include('vendas.formaPagamentoCreate')
                        @endif


                    </div>
                </div>
            </div>


            <div id="load_tweets"></div>
            <input class="form-control" style="font-size: 30px;width: 150px" readonly id="valorFormas"><br>
            {{ csrf_field() }}

            <div class="text-right">
                <button type="submit"
                        class="btn btn-primary">{{isset($venda) ? 'Atualizar' : 'Gerar Venda' }} <i
                            class="icon-arrow-right14 position-right"></i></button>
            </div>

            {{ Form::close() }}

        </div>
    </div>
@endsection

@push('scripts')

<script src="/js/vendas.js"></script>

{{--{!! Html::script('js/selectMultinivel.js')!!}--}}

@endpush


