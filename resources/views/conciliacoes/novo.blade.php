<div id="myModalNovoPagamento" class="modal fade" data-backdrop="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Titulo</h5>
            </div>

            <div class="modal-body">

            {{ Form::open(array('url' => '/contas_a_pagar','class'=>'form-horizontal',
            'id' => 'formExemplo','data-toggle' => 'validator', 'role' => 'form')) }}
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
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="estado" class="control-label">Tipos de Despesa</label>
                            {!! Form::select('tipo_despesa_id', $pagamento['tiposDespesas'], '',
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
                            {!! Form::select('centro_de_custo_id', $pagamento['centrosDeCusto'],'',
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
                            {!! Form::select('tipo_pagamento_id', $pagamento['tiposPagamentos'],'',
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
                            {!! Form::select('sub_tipo_pagamento_id', $pagamento['subTiposPagamentos'],'',
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
                            <input id="data_pagamento" class="form-control date form-control-danger" value=""
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
                            {!! Form::select('fornecedor_id', $pagamento['fornecedores'],'',
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
                    <div class="col-lg-9">
                        <label for="conta_id" class="control-label">Categorias Contábeis</label>
                        <div class="form-group">

                            @include('shared.selectSearch')
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
                                      class="form-control form-control-danger" name="descricao" data-error="preencha a descrição"
                                      placeholder="ex: pagamento referente a compra de 100kg de feijão..."></textarea>
                            <div class="help-block with-errors form-control-feedback"></div>
                        </div>
                    </div>
                </div>

                <input type="hidden" class="id_div" name="id_div" value="">

                <div class="text-right">
                    <button type="submit"
                            class="btn btn-primary"> Cadastrar<i
                                class="icon-arrow-right14 position-right"></i></button>
                </div>


            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>


<div id="myModalNovoRecebimento" class="modal fade" data-backdrop="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Titulo</h5>
            </div>

            <div class="modal-body">

                {{ Form::open(array('url' => '/contas_a_receber/store','class'=>'form-horizontal',
                'id' => 'formExemplo','data-toggle' => 'validator', 'role' => 'form')) }}


                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="cliente_id" class="control-label">Clientes</label>
                            {!! Form::select('cliente_id', $recebimento['clientes'], '',
                            ['id' => 'cliente_id','required','class'=>'select2 form-control-danger',
                            'placeholder'=>'Selecione o Cliente'
                            ,'data-error' => 'escolha o cliente.']) !!}
                            <small class="form-text text-muted">
                                <div class="help-block with-errors form-control-feedback"></div>
                            </small>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="forma_de_pagamento_id" class="control-label">Formas de Pagamento</label>
                            {!! Form::select('forma_de_pagamento_id', $recebimento['formasDePagamento'],'',
                            ['id' => 'forma_de_pagamento_id','required','class'=>'select2 form-control-danger',
                            'placeholder'=>'Formas de Pagamento'
                            ,'data-error' => 'escolha a forma de pagamento.']) !!}
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
                            <input id="data_vencimento" class="form-control date  form-control-danger" value=""
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
                            <input id="data_pagamento" class="form-control date form-control-danger" value=""
                                   name="data_pagamento" placeholder="Data de Pagamento"
                                   data-error="Informe a data de pagamento.">
                            <small class="form-text text-muted">
                                <div class="help-block with-errors form-control-feedback"></div>
                            </small>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-9">
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
                    <div class="col-lg-9">
                        <label for="conta_id" class="control-label">Categorias Contábeis</label>
                        <div class="form-group">

                            @include('shared.selectSearch')

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
                                      class="form-control form-control-danger" name="descricao" data-error="preencha a descrição"
                                      placeholder="ex: pagamento referente a compra de 100kg de feijão..."></textarea>
                            <div class="help-block with-errors form-control-feedback"></div>
                        </div>
                    </div>
                </div>

                <input type="hidden" class="id_div" name="id_div" value="">

                <div class="text-right">
                    <button type="submit"
                            class="btn btn-primary"> Cadastrar<i
                                class="icon-arrow-right14 position-right"></i></button>
                </div>


                {{ Form::close() }}

            </div>
        </div>

    </div>
</div>



