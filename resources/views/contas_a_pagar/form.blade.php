@extends('template.template')
@section('content')

    <?php isset($contas_a_pagar) ?

        $paramns = [
            'nome' => 'Atualização de Contas a Pagar',
            'breadcrum' => [
                [
                    'nome' => 'Contas a Pagar',
                    'url' => '/contas_a_pagar'
                ],
                [
                    'nome' => 'Atualização de Contas a Pagar',
                    'url' => ''
                ]
            ]
        ] :

        $paramns = [
            'nome' => 'Cadastro de Contas a Pagar',
            'breadcrum' => [
                [
                    'nome' => 'Contas a Pagar',
                    'url' => '/contas_a_pagar'
                ],
                [
                    'nome' => 'Cadastro de Contas a Pagar',
                    'url' => ''
                ]
            ]
        ]?>

    @include('shared.header',$paramns)

    <!-- Form horizontal -->
    @if(isset($contas_a_pagar))
        {{ Form::model($contas_a_pagar, array('route' => array('contas_a_pagar.update', $contas_a_pagar->id),
        'class'=>'form-horizontal', 'method' => 'PUT',
        'id' => 'formExemplo','data-toggle' => 'validator', 'role' => 'form')) }}
    @else
        {{ Form::open(array('url' => '/contas_a_pagar','class'=>'form-horizontal',
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
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="estado" class="control-label">Tipos de Despesa</label>
                        {!! Form::select('tipo_despesa_id', $load['tiposDespesas'],
                        isset($contas_a_pagar)? $contas_a_pagar->tiposDespesas->id : '',
                        ['id' => 'tipo_despesa_id','required','class'=>'select2 form-control-danger',
                        'placeholder'=>'Selecione o Tipo de Despesa'
                        ,'data-error' => 'Informe o tipo de despesa.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="estado" class="control-label">Centros de Custos</label>
                        {!! Form::select('centro_de_custo_id', $load['centrosDeCusto'],
                        isset($contas_a_pagar)? $contas_a_pagar->centrosDeCusto->id : '',
                        ['id' => 'centro_de_custo_id','required','class'=>'select2 form-control-danger',
                        'placeholder'=>'Selecione o Centro de Custo'
                        ,'data-error' => 'Informe o centro de custo.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="tipo_pagamento_id" class="control-label">Tipo de Pagamento</label>
                        {!! Form::select('tipo_pagamento_id', $load['tiposPagamentos'],
                        isset($contas_a_pagar)? $contas_a_pagar->subtiposPagamentos->tipoPagamentos->id  : '',
                        ['id' => 'tipo_pagamento_id','required','class'=>'select2 pgto form-control-danger',
                        'placeholder'=>'Selecione o Tipo de Pagamento'
                        ,'data-error' => 'Informe o tipo de pagamento.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="sub_tipo_pagamento_id" class="control-label">Sub Tipo de Pagamento</label>
                        {!! Form::select('sub_tipo_pagamento_id', $load['subTiposPagamentos'],
                        isset($contas_a_pagar)? $contas_a_pagar->subtiposPagamentos->id : '',
                        ['id' => 'sub_tipo_pagamento_id','required','class'=>'select2 subpgto form-control-danger',
                        'placeholder'=>'Selecione o sub tipo de Pagamento'
                        ,'data-error' => 'Informe o sub tipo de pagamento.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="data_vencimento" class="control-label">Data de Vencimento</label>
                        <input id="data_vencimento" class="form-control date  form-control-danger"
                               @if(isset($contas_a_pagar)) value="@date($contas_a_pagar->data_vencimento)"
                               @else value="{{null}}" @endif
                               name="data_vencimento" required placeholder="Data de Vencimento"
                               data-error="Informe a data de vencimento.">
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="data_pagamento" class="control-label">Data de Pagamento</label>
                        <input id="data_pagamento" class="form-control date form-control-danger"
                               @if(isset($contas_a_pagar)) value="@date($contas_a_pagar->data_pagamento)"
                               @else value="{{null}}" @endif
                               name="data_pagamento" placeholder="Data de Pagamento"
                               data-error="Informe a data de pagamento.">
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="fornecedor_id" class="control-label">Fornecedor</label>
                        {!! Form::select('fornecedor_id', $load['fornecedores'],
                        isset($contas_a_pagar)? $contas_a_pagar->fornecedores->id : '',
                        ['id' => 'fornecedor_id','required','class'=>'select2 form-control-danger',
                        'placeholder'=>'Selecione o Fornecedor'
                        ,'data-error' => 'Informe o fornecedor.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="valor" class="control-label">Valor</label>
                        {!! Form::input('text','valor',null,
                        ['id' => 'valor','class'=>'form-control money form-control-danger',
                        'placeholder'=>'Digite o valor...','required',
                        'data-error' => 'Informe o valor.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="desconto" class="control-label">Descontos</label>
                        {!! Form::input('text','desconto',null,
                        ['id' => 'desconto','class'=>'form-control money form-control-danger',
                        'placeholder'=>'Digite o desconto...',
                        'data-error' => 'Informe o desconto.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="deducao" class="control-label">Deduções</label>
                        {!! Form::input('text','deducao',null,
                        ['id' => 'deducao','class'=>'form-control money form-control-danger',
                        'placeholder'=>'Digite a dedução...',
                        'data-error' => 'Informe a dedução.']) !!}
                        <div class="help-block with-errors form-control-feedback"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="juros" class="control-label">Juros</label>
                        {!! Form::input('text','juros',null,
                        ['id' => 'juros','class'=>'form-control money form-control-danger',
                        'placeholder'=>'Digite os juros...',
                        'data-error' => 'Informe os juros.']) !!}
                        <div class="help-block with-errors form-control-feedback"></div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="acrescimos" class="control-label">Acréscimos</label>
                        {!! Form::input('text','acrescimos',null,
                        ['id' => 'acrescimos','class'=>'form-control  money form-control-danger',
                        'placeholder'=>'Digite os acréscimos...',
                        'data-error' => 'Informe os acréscimos.']) !!}
                        <div class="help-block with-errors form-control-feedback"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <label for="conta_id" class="control-label">Categorias Contábeis</label>
                    <div class="form-group">
                        <?php isset($contas_a_pagar) ? $id_cat = $contas_a_pagar->conta_id : $id_cat = null; ?>

                        {{--@include('shared.selectSearch',compact('array','id_cat'))--}}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-9">
                    <div class="form-group">
                        <label for="descricao" class="control-label">Descricao</label>
                        <textarea id="descricao" type="text" rows="4" cols="4"
                                  class="form-control form-control-danger" name="descricao"
                                  data-error="preencha a descrição"
                                  placeholder="ex: pagamento referente a compra de 100kg de feijão..."
                        >{{isset($contas_a_pagar)? $contas_a_pagar->descricao : ''}}</textarea>
                        <div class="help-block with-errors form-control-feedback"></div>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="submit"
                        class="btn btn-primary">{{isset($contas_a_pagar) ? 'Atualizar' : 'Cadastrar' }} <i
                            class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
    </div>
    Form::close() }}
@endsection('content')


