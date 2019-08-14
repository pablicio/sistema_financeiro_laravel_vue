@extends('template.template')
@section('content')
    <!-- Page header -->

    <?php isset($orcamento) ?

        $paramns = [
            'nome' => 'Atualização de Orçamentos',
            'breadcrum' => [
                [
                    'nome' => 'Clientes',
                    'url' => '/clientes'
                ],
                [
                    'nome' => 'Orçamentos de ' . $orcamento->cliente->present,
                    'url' => '/orcamentos/' . $orcamento->cliente->id . '/clienteOrcamentos'
                ],
                [
                    'nome' => 'Atualização de Orçamentos',
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
                    'nome' => 'Orcamentos de ' . $cliente->present,
                    'url' => '/orcamentos/' . $cliente->id . '/clienteOrcamentos'
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
    @if(isset($orcamento))
        {{ Form::model($orcamento, array('route' => array('orcamentos.update', $orcamento->id),
        'class'=>'form-horizontal', 'method' => 'PUT',
        'id' => 'formExemplo','data-toggle' => 'validator', 'role' => 'form')) }}
    @else
        {{ Form::open(array('url' => '/orcamentos/'.$id,'class'=>'form-horizontal',
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
                                  class="form-control" name="orcamento[descricao]"
                                  data-error="preencha a descrição"
                                  placeholder="ex: Prezado cliente, segue o orçamento refente a sua solicitação"
                        >{{isset($orcamento)? $orcamento->descricao : ''}}</textarea>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>


            <legend class="text-bold"></legend>

            @if(!isset($orcamento))
                @include('orcamentos.tabelaProdutos')
                @include('orcamentos.tabelaServicos')

                <input type="hidden" name="cliente_id" value="{{ $id }}">
                <input type="hidden" name="orcamento[cliente_id]" value="{{ $id }}">
            @else
                @include('orcamentos.tabelaProdutosEdit')
                @include('orcamentos.tabelaServicosEdit')
                <input type="hidden" name="cliente_id" value="{{ $orcamento->cliente_id }}">
                <input type="hidden" name="orcamento[cliente_id]" value="{{ $orcamento->cliente_id  }}">
            @endif


            <legend class="text-bold">Dados do orçamento</legend>


            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="funcionario_id" class="control-label">Vendedor</label>
                        {!! Form::select('orcamento[funcionario_id]',
                          $load['funcionarios'],isset($orcamento)? $orcamento->funcionarios->id:'',
                          ['id' => 'funcionario_id','required','class'=>'form-control estados',
                          'placeholder'=>'*** Vendedor Responsável ***','data-error' => 'Informe o vendedor.']) !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="data_venda" class="control-label">Data do Orçamento</label>
                        <input required id="data_venda" class="form-control date" @if(isset($orcamento))
                        value="@date($orcamento->data_venda)" @else value="" @endif
                               name="orcamento[data_venda]" placeholder="Data do Orçamento"
                               data-error="Informe a data do orçamento">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="previsao_entrega" class="control-label">Previsão de Entrga</label>
                        <input required id="previsao_entrega" class="form-control date"
                               @if(isset($orcamento)) value="{{$orcamento->previsao_entrega}}"
                               @else value="" @endif name="orcamento[previsao_entrega]"
                               placeholder="Previsão de Entrega" data-error="Informe a previsão de entrega">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="validade_orcamento" class="control-label">Validade do Orçamento</label>
                        <input required id="validade_orcamento" class="form-control date" @if(isset($orcamento))
                        value="{{$orcamento->validade_orcamento}}" @else value="" @endif
                               name="orcamento[validade_orcamento]" placeholder="Validade do Orçamento"
                               data-error="Informe a validade do orçamento">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>


            <legend class="text-bold">Formas de pagamento</legend>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="formas_pagamento" class="control-label">Formas de Pagamento</label>
                        <textarea id="formas_pagamento" required type="text" rows="4" cols="4"
                                  class="form-control" name="orcamento[formas_pagamento]"
                                  data-error="preencha as forma de pagamento"
                                  placeholder="ex: boleto, cheque, parcelado no débito em 3x..."
                        >{{isset($orcamento)? $orcamento->formas_pagamento : ''}}</textarea>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>


            <div class="text-right">
                <button type="submit"
                        class="btn btn-primary">{{isset($orcamento) ? 'Atualizar' : 'Gerar Orçamento' }} <i
                            class="icon-arrow-right14 position-right"></i></button>
            </div>

            {{ csrf_field() }}

            {{ Form::close() }}
        </div>
    </div>

@endsection

@push('scripts')

<script src="/js/orcamentos.js"></script>
@endpush
