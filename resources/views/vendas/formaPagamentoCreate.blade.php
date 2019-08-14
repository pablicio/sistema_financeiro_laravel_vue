<div class="tab-content">

    {{--DINHEIRO--}}
    <div class="tab-pane active" role="tabpanel" id="tab1">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="dinheiroVencimento" class="control-label">Data de Vencimento</label>
                    {!! Form::input('text','dinheiro[data_vencimento]',null,
                    ['class'=>'form-control date pdinheiro','placeholder'=>'Data de Vencimento'
                    ,'id' => 'dinheiroVencimento','data-error' => 'Informe a data de vencimento.']) !!}
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Data de Pagamento</label>
                    {!! Form::input('text','dinheiro[data_pagamento]',null,
                    ['class'=>'form-control date','placeholder'=>'Data de Pagamento'
                    ,'id' => 'dinheiroPagamento']) !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="dinheiroValor" class="control-label">Valor</label>
                    {!! Form::input('text','dinheiro[valor]',null,
                    ['class'=>'form-control valorTira money vdinheiro','placeholder'=>'Valor'
                    ,'id' => 'dinheiroValor','data-error' => 'Informe o valor.']) !!}
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>

        <input type="hidden" name="dinheiro[forma_de_pagamento_id]" value="1">
    </div>


    {{--CARTÃO DE CRÉDITO--}}
    <div class="tab-pane" role="tabpanel" id="tab2">
        <div id="camposCredito">
            <div class="row">
                <div class="col-md-1">
                    <input type="hidden" name="cartao_credito0[forma_de_pagamento_id]"
                           value="2">
                    <input type="button" class="btn btn-success" id="addCampoCredito"
                           value="+">
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="pcartaoCredito" class="control-label">Bandeira</label>
                        {!! Form::select('cartao_credito0[cartao_id]',  $load['cartoes'],null,
                        ['class'=>'select2 pcartaoCredito','placeholder'=>'*** CARTÃO ***'
                        ,'id' => 'pcartaoCredito','data-error' => 'Informe a bandeira.']) !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label">Total de Parcelas</label>
                        {!! Form::input('text','cartao_credito0[total_parcelas]',null,
                        ['class'=>'form-control','placeholder'=>'Total Parcelas']) !!}
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cartao_creditoVencimento" class="control-label">Vencimento</label>
                        {!! Form::input('text','cartao_credito0[data_vencimento]',null,
                        ['class'=>'form-control date pcartaoCredito','placeholder'=>'Vencimento'
                        ,'id' => 'cartao_creditoVencimento','data-error' => 'Informe a data de vencimento.']) !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label">Pagamento</label>
                        {!! Form::input('text','cartao_credito0[data_pagamento]',null,
                        ['class'=>'form-control date','placeholder'=>'Pagamento']) !!}
                    </div>

                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cartao_creditoValor" class="control-label">Valor</label>
                        {!! Form::input('text','cartao_credito0[valor]',null,
                        ['class'=>'form-control valorTira money vcartaoCredito', 'placeholder'=>'Valor'
                        ,'id' => 'cartao_creditoValor','data-error' => 'Informe o valor.']) !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--CARTÃO DE DEBITO--}}
    <div class="tab-pane" role="tabpanel" id="tab3">
        <div id="camposDebito">
            <div class="row">
                <div class="col-lg-1">
                    <input type="hidden" name="cartao_debito0[forma_de_pagamento_id]"
                           value="3">
                    <input type="button" class="btn btn-success" id="addCampoDebito"
                           value="+">
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="cartao_debitoBandeira" class="control-label">Bandeira</label>
                        {!! Form::select('cartao_debito0[cartao_id]',  $load['cartoes'],null,
                        ['class'=>'select2 pcartaoDebito','placeholder'=>'*** CARTÃO ***'
                        ,'id' => 'cartao_debitoBandeira','data-error' => 'Informe a bandeira.']) !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label">Total de Parcelas</label>
                        {!! Form::input('text','cartao_debito0[total_parcelas]',null,
                        ['class'=>'form-control','placeholder'=>'Total Parcelas']) !!}

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cartao_debitoVencimento" class="control-label">Vencimento</label>
                        {!! Form::input('text','cartao_debito0[data_vencimento]',null,
                        ['class'=>'form-control date pcartaoDebito','placeholder'=>'Vencimento'
                        ,'id' => 'cartao_debitoVencimento','data-error' => 'Informe a data de vencimento.']) !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label">Pagamento</label>
                        {!! Form::input('text','cartao_debito0[data_pagamento]',null,
                        ['class'=>'form-control date','placeholder'=>'Pagamento']) !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cartao_debitoValor" class="control-label">Valor</label>
                        {!! Form::input('text','cartao_debito0[valor]',null,
                        ['class'=>'form-control valorTira money vcartaoDebito','placeholder'=>'Valor'
                        ,'id' => 'cartao_debitoValor','data-error' => 'Informe o valor.']) !!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--BOLETO--}}
    <div class="tab-pane" role="tabpanel" id="tab4">
        <div class="row">
            <div class="col-lg-1"></div>

            <div class="col-md-3">

                <div class="form-group">
                    <label for="boletoVencimento" class="control-label">Vencimento</label>
                    {!! Form::input('text','boleto[data_vencimento]',null,
                    ['class'=>'form-control date pboleto','placeholder'=>'Vencimento'
                    ,'id' => 'boletoVencimento','data-error' => 'Informe a data de vencimento.']) !!}
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-3">

                <div class="form-group">
                    <label class="control-label">Pagamento</label>
                    {!! Form::input('text','boleto[data_pagamento]',null,
                    ['class'=>'form-control date','placeholder'=>'Pagamento']) !!}
                </div>

            </div>
            <div class="col-md-3">

                <div class="form-group">
                    <label for="boletoValor" class="control-label">Valor</label>
                    {!! Form::input('text','boleto[valor]',null,
                    ['class'=>'form-control valorTira money vboleto', 'placeholder'=>'Valor'
                    ,'id' => 'boletoValor','data-error' => 'Informe o valor.']) !!}
                    <div class="help-block with-errors"></div>
                </div>

            </div>
            <input type="hidden" name="boleto[forma_de_pagamento_id]" value="4">
        </div>
    </div>


    {{--CHEQUE--}}
    <div class="tab-pane" role="tabpanel" id="tab6">
        <div class="row">
            <div class="col-lg-1">
                <input type="hidden" name="cheque[forma_de_pagamento_id]" value="5">
            </div>
            <div class="col-lg-3">

                <div class="form-group">
                    <label for="chequeBanco" class="control-label">Banco</label>
                    {!! Form::select('cheque[banco_id]',  $load['bancos'],null,
                    ['class'=>'select2 pcheque','placeholder'=>'*** BANCO ***'
                    ,'id' => 'chequeBanco','data-error' => 'Informe o banco.']) !!}
                    <div class="help-block with-errors"></div>
                </div>

            </div>
            <div class="col-md-2">

                <div class="form-group">
                    <label for="chequeNumero" class="control-label">Número</label>
                    {!! Form::input('text','cheque[numero_cheque]',null,
                    ['class'=>'form-control pcheque','placeholder'=>'N° Cheque'
                    ,'id' => 'chequeNumero','data-error' => 'Informe o número.']) !!}
                    <div class="help-block with-errors"></div>
                </div>

            </div>
            <div class="col-md-2">

                <div class="form-group">
                    <label for="chequeVencimento" class="control-label">Vencimento</label>
                    {!! Form::input('text','cheque[data_vencimento]',null,
                    ['class'=>'form-control date pcheque','placeholder'=>'Vencimento'
                    ,'id' => 'chequeVencimento','data-error' => 'Informe a data de vencimento.']) !!}
                    <div class="help-block with-errors"></div>
                </div>

            </div>
            <div class="col-md-2">

                <div class="form-group">
                    <label class="control-label">Pagamento</label>
                    {!! Form::input('text','cheque[data_pagamento]',null,
                    ['class'=>'form-control date','placeholder'=>'Pagamento']) !!}
                </div>

            </div>
            <div class="col-md-2">

                <div class="form-group">
                    <label for="chequeValor" class="control-label">Valor</label>
                    {!! Form::input('text','cheque[valor]',null,
                    ['class'=>'form-control valorTira money vcheque','placeholder'=>'Valor'
                    ,'id' => 'chequeValor','data-error' => 'Informe o valor.']) !!}
                    <div class="help-block with-errors"></div>
                </div>

            </div>
        </div>
    </div>

    <div class="tab-pane" role="tabpanel" id="tab7">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-3">

                <div class="form-group">
                    <label for="outraForma" class="control-label">Forma de Pagamento</label>
                    {!! Form::select('outra[forma_de_pagamento_id]',  $load['formas_pagamento'],null,
                    ['class'=>'select2 poutra','placeholder'=>'*** FORMA ***'
                    ,'id' => 'outraForma','data-error' => 'Informe a forma de pagamento.']) !!}
                    <div class="help-block with-errors"></div>
                </div>

            </div>
            <div class="col-md-2">

                <div class="form-group">
                    <label for="outraVencimento" class="control-label">Vencimento</label>
                    {!! Form::input('text','outra[data_vencimento]',null,
                    ['class'=>'form-control date poutra','placeholder'=>'Vencimento'
                    ,'id' => 'outraVencimento','data-error' => 'Informe a data de vencimento.']) !!}
                    <div class="help-block with-errors"></div>
                </div>

            </div>
            <div class="col-md-2">

                <div class="form-group">
                    <label class="control-label">Pagamento</label>
                    {!! Form::input('text','outra[data_pagamento]',null,
                    ['class'=>'form-control date','placeholder'=>'Pagamento']) !!}
                </div>

            </div>
            <div class="col-md-2">

                <div class="form-group">
                    <label for="outraValor" class="control-label">Valor</label>
                    {!! Form::input('text','outra[valor]',null,
                    ['class'=>'form-control valorTira money voutra','placeholder'=>'Valor'
                    ,'id' => 'outraValor','data-error' => 'Informe o valor.']) !!}
                    <div class="help-block with-errors"></div>
                </div>
            </div>

        </div>
    </div>
</div>