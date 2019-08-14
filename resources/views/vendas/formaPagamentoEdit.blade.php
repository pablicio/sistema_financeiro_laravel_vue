<div class="tab-content">
    <?php $sentinela = true; ?>
    {{--DINHEIRO--}}
    @foreach($venda->contasAReceber as $key => $item)
        @if($item->forma_de_pagamento_id == 1)
            <div class="tab-pane active" role="tabpanel" id="tab1">
                <div class="row">
                    
                    <div class="col-lg-1">
                        <input type="hidden" name="dinheiro[forma_de_pagamento_id]" value="1">
                        <input type="hidden" name="dinheiro[id]" value="{{$item->id}}">

                    </div>
                    <div class="col-lg-2">
                        <label class="control-label">Data de Vencimento</label>
                        <input type="text" name="dinheiro[data_vencimento]" value="@date($item->data_vencimento)"
                               placeholder="Data de Vencimento" class="form-control date">
                    </div>
                    <div class="col-lg-2">
                        <label class="control-label">Data de Pagamento</label>
                        <input type="text" name="dinheiro[data_pagamento]" value="@date($item->data_pagamento)"
                               placeholder="Data de Pagamento" class="form-control date">
                    </div>

                    <div class="col-lg-2">
                        <label class="control-label">Valor</label>
                        {!! Form::input('text','dinheiro[valor]','R$ '.$item->decimalMoney($item->valor),
                        ['class'=>'form-control valorTira money','placeholder'=>'Valor']) !!}
                    </div>
                </div>
            </div>
            <?php $sentinela = false; ?>
        @endif
    @endforeach

    @if($sentinela)
        <div class="tab-pane" role="tabpanel" id="tab1">
            <div class="row">
                
                <div class="col-lg-1">
                </div>
                <div class="col-lg-2">
                    <label class="control-label">Data de Vencimento</label>
                    {!! Form::input('text','dinheiro[data_vencimento]',null,
                    ['class'=>'form-control date','placeholder'=>'Data de Vencimento']) !!}
                </div>
                <div class="col-lg-2">
                    <label class="control-label">Data de Pagamento</label>
                    {!! Form::input('text','dinheiro[data_pagamento]',null,
                    ['class'=>'form-control date','placeholder'=>'Data de Pagamento']) !!}
                </div>
                <div class="col-lg-2">
                    <label class="control-label">Valor</label>
                    {!! Form::input('text','dinheiro[valor]',null,
                    ['class'=>'form-control valorTira money','placeholder'=>'Valor']) !!}
                </div>
                <input type="hidden" name="dinheiro[forma_de_pagamento_id]" value="1">
            </div>
        </div>
    @endif

    <?php $sentinela = true; ?>

    {{--CARTÃO DE CRÉDITO--}}
    <div class="tab-pane" role="tabpanel" id="tab2">
        <div id="camposCredito">
            @foreach($venda->contasAReceber->groupby('forma_de_pagamento_id') as $key => $item)
                {{--DINHEIRO--}}
                @if($key == 2)
                    <input type="button" class="btn btn-success" id="addCampoCredito"
                           value="+">
                    @foreach($item as $conta)
                        <div class="row">
                            <div class="col-lg-1">
                                <input type="hidden" name="cartao_credito[forma_de_pagamento_id]"
                                       value="2">
                                <input type="hidden" name="cartao_credito[id]" value="{{$conta->id}}">
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">Bandeira</label>
                                {!! Form::select('cartao_credito[cartao_id]',  $load['cartoes'],$conta->cartao_id,
                                ['class'=>'form-control','placeholder'=>'*** CARTÃO ***']) !!}
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">Total de Parcelas</label>
                                {!! Form::input('text','cartao_credito[total_parcelas]',$conta->total_parcelas,
                                ['class'=>'form-control','placeholder'=>'Total Parcelas']) !!}
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">Data de Vencimento</label>
                                <input type="text" name="cartao_credito[data_vencimento]"
                                       value="@date($conta->data_vencimento)"
                                       placeholder="Data de Vencimento" class="form-control date">
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">Data de Pagamento</label>
                                <input type="text" name="cartao_credito[data_pagamento]"
                                       value="@date($conta->data_pagamento)"
                                       placeholder="Data de Pagamento" class="form-control date">
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">Valor</label>
                                {!! Form::input('text','cartao_credito[valor]',"R$ ".$conta->decimalMoney($conta->valor),
                                ['class'=>'form-control valorTira money', 'placeholder'=>'Valor']) !!}
                            </div>
                        </div>
                    @endforeach
                    <?php $sentinela = false; ?>
                @endif
            @endforeach
            @if($sentinela)

                <div class="row">
                    <div class="col-lg-1">
                        <input type="hidden" name="cartao_credito[forma_de_pagamento_id]"
                               value="2">
                        <input type="button" class="btn btn-success" id="addCampoCredito"
                               value="+">
                    </div>

                    <div class="col-lg-2">
                        <label class="control-label">Bandeira</label>
                        {!! Form::select('cartao_credito[cartao_id]',  $load['cartoes'],null,
                        ['class'=>'form-control','placeholder'=>'*** CARTÃO ***']) !!}
                    </div>
                    <div class="col-lg-2">
                        <label class="control-label">Total de Parcelas</label>
                        {!! Form::input('text','cartao_credito[total_parcelas]',null,
                        ['class'=>'form-control','placeholder'=>'Total Parcelas']) !!}
                    </div>

                    <div class="col-lg-2">
                        <label class="control-label">Data de Vencimento</label>
                        {!! Form::input('text','cartao_credito[data_vencimento]',null,
                        ['class'=>'form-control date','placeholder'=>'Data de Vencimento']) !!}
                    </div>
                    <div class="col-lg-2">
                        <label class="control-label">Data de Pagamento</label>
                        {!! Form::input('text','cartao_credito[data_pagamento]',null,
                        ['class'=>'form-control date','placeholder'=>'Data de Pagamento']) !!}
                    </div>
                    <div class="col-lg-2">
                        <label class="control-label">Valor</label>
                        {!! Form::input('text','cartao_credito[valor]',null,
                        ['class'=>'form-control valorTira money', 'placeholder'=>'Valor']) !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <?php $sentinela = true; ?>

    {{--CARTÃO DE DEBITO--}}
    <div class="tab-pane" role="tabpanel" id="tab3">
        <div id="camposDebito">
            @foreach($venda->contasAReceber->groupby('forma_de_pagamento_id') as $key => $item)
                {{--DINHEIRO--}}
                @if($key == 3)
                    <input type="button" class="btn btn-success" id="addCampoDebito"
                           value="+">
                    @foreach($item as $key => $conta)
                        <div class="row">
                            <div class="col-lg-1">
                                <input type="hidden" name="cartao_debito[forma_de_pagamento_id]"
                                       value="3">
                                <input type="hidden" name="cartao_debito[id]" value="{{$conta->id}}">

                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">Bandeira</label>
                                {!! Form::select('cartao_debito[cartao_id]',  $load['cartoes'],$conta->cartao_id,
                                ['class'=>'form-control','placeholder'=>'*** CARTÃO ***']) !!}
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">Total de Parcelas</label>
                                {!! Form::input('text','cartao_debito[total_parcelas]',$conta->total_parcelas,
                                ['class'=>'form-control','placeholder'=>'Total Parcelas']) !!}
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">Data de Vencimento</label>
                                <input type="text" name="cartao_debito[data_vencimento]"
                                       value="@date($conta->data_vencimento)"
                                       placeholder="Data de Vencimento" class="form-control date">
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">Data de Pagamento</label>
                                <input type="text" name="cartao_debito[data_pagamento]"
                                       value="@date($conta->data_pagamento)"
                                       placeholder="Data de Pagamento" class="form-control date">
                            </div>

                            <div class="col-lg-2">
                                <label class="control-label">Valor</label>
                                {!! Form::input('text','cartao_debito[valor]',"R$ ".$conta->decimalMoney($conta->valor),
                                ['class'=>'form-control valorTira money','placeholder'=>'Valor']) !!}
                            </div>
                        </div>
                    @endforeach
                    <?php $sentinela = false; ?>
                @endif
            @endforeach
            @if($sentinela)
                <div class="row">
                    <div class="col-lg-1">
                        <input type="hidden" name="cartao_debito[forma_de_pagamento_id]"
                               value="3">
                        <input type="button" class="btn btn-success" id="addCampoDebito"
                               value="+">
                    </div>
                    <div class="col-lg-2">
                        <label class="control-label">Bandeira</label>
                        {!! Form::select('cartao_debito[cartao_id]',  $load['cartoes'],null,
                        ['class'=>'form-control','placeholder'=>'*** CARTÃO ***']) !!}
                    </div>
                    <div class="col-lg-2">
                        <label class="control-label">Total de Parcelas</label>
                        {!! Form::input('text','cartao_debito[total_parcelas]',null,
                        ['class'=>'form-control','placeholder'=>'Total Parcelas']) !!}
                    </div>
                    <div class="col-lg-2">
                        <label class="control-label">Data de Vencimento</label>
                        {!! Form::input('text','cartao_debito[data_vencimento]',null,
                        ['class'=>'form-control date','placeholder'=>'Data de Vencimento']) !!}
                    </div>
                    <div class="col-lg-2">
                        <label class="control-label">Data de Pagamento</label>
                        {!! Form::input('text','cartao_debito[data_pagamento]',null,
                        ['class'=>'form-control date','placeholder'=>'Data de Pagamento']) !!}
                    </div>
                    <div class="col-lg-2">
                        <label class="control-label">Valor</label>
                        {!! Form::input('text','cartao_debito[valor]',null,
                        ['class'=>'form-control valorTira money','placeholder'=>'Valor']) !!}
                    </div>
                </div>
            @endif
        </div>
    </div>


    <?php $sentinela = true; ?>

    @foreach($venda->contasAReceber as $key => $item)
        {{--BOLETO--}}
        @if($item->forma_de_pagamento_id == 4)
            <div class="tab-pane" role="tabpanel" id="tab4">
                <div class="row">
                    <div class="col-lg-1">
                        <input type="hidden" name="boleto[id]" value="{{$item->id}}">
                        <input type="hidden" name="boleto[forma_de_pagamento_id]" value="4">

                    </div>

                    <div class="col-lg-2">
                        <label class="control-label">Data de Vencimento</label>
                        <input type="text" name="boleto[data_vencimento]"
                               value="@date($item->data_vencimento)"
                               placeholder="Data de Vencimento" class="form-control date">
                    </div>
                    <div class="col-lg-2">
                        <label class="control-label">Data de Pagamento</label>
                        <input type="text" name="boleto[data_pagamento]"
                               value="@date($item->data_pagamento)"
                               placeholder="Data de Pagamento" class="form-control date">
                    </div>

                    <div class="col-lg-2">
                        <label class="control-label">Valor</label>
                        {!! Form::input('text','boleto[valor]',"R$ ".$item->decimalMoney($item->valor),
                        ['class'=>'form-control valorTira money', 'placeholder'=>'Valor']) !!}
                    </div>
                </div>
            </div>
            <?php $sentinela = false; ?>
        @endif
    @endforeach

    @if($sentinela)
        {{--BOLETO--}}
        <div class="tab-pane" role="tabpanel" id="tab4">
            <div class="row">
                <div class="col-lg-1">
                </div>

                <div class="col-lg-2">
                    <label class="control-label">Data de Vencimento</label>
                    {!! Form::input('text','boleto[data_vencimento]',null,
                    ['class'=>'form-control date','placeholder'=>'Data de Vencimento']) !!}
                </div>
                <div class="col-lg-2">
                    <label class="control-label">Data de Pagamento</label>
                    {!! Form::input('text','boleto[data_pagamento]',null,
                    ['class'=>'form-control date','placeholder'=>'Data de Pagamento']) !!}
                </div>
                <div class="col-lg-2">
                    <label class="control-label">Valor</label>
                    {!! Form::input('text','boleto[valor]',null,
                    ['class'=>'form-control valorTira money', 'placeholder'=>'Valor']) !!}
                </div>
                <input type="hidden" name="boleto[forma_de_pagamento_id]" value="4">
            </div>
        </div>
    @endif

    <?php $sentinela = true; ?>

    @foreach($venda->contasAReceber as $key => $item)
        {{--CHEQUE--}}
        @if($item->forma_de_pagamento_id == 5)
            <div class="tab-pane" role="tabpanel" id="tab6">
                <div class="row">
                    <div class="col-lg-1">
                        <input type="hidden" name="cheque[id]" value="{{$item->id}}">
                        <input type="hidden" name="cheque[forma_de_pagamento_id]" value="5">
                    </div>

                    <div class="col-lg-2">
                        <label class="control-label">Número</label>
                        {!! Form::input('text','cheque[numero_cheque]',$item->numero_cheque,
                        ['class'=>'form-control','placeholder'=>'N° Cheque']) !!}
                    </div>
                    <div class="col-lg-2">
                        <label class="control-label">Banco</label>
                        {!! Form::select('cheque[banco_id]',  $load['bancos'],$item->banco_id,
                        ['class'=>'form-control','placeholder'=>'*** BANCO ***']) !!}
                    </div>
                    <div class="col-lg-2">
                        <label class="control-label">Data de Vencimento</label>
                        <input type="text" name="cheque[data_vencimento]"
                               value="@date($item->data_vencimento)"
                               placeholder="Data de Vencimento" class="form-control date">
                    </div>
                    <div class="col-lg-2">
                        <label class="control-label">Data de Pagamento</label>
                        <input type="text" name="cheque[data_pagamento]"
                               value="@date($item->data_pagamento)"
                               placeholder="Data de Pagamento" class="form-control date">
                    </div>
                    <div class="col-lg-2">
                        <label class="control-label">Valor</label>
                        {!! Form::input('text','cheque[valor]',"R$ ".$item->decimalMoney($item->valor),
                        ['class'=>'form-control valorTira money','placeholder'=>'Valor']) !!}
                    </div>
                </div>
            </div>
            <?php $sentinela = false; ?>
        @endif
    @endforeach

    @if($sentinela)

        <div class="tab-pane" role="tabpanel" id="tab6">
            <div class="row">
                <div class="col-lg-1">

                </div>

                <div class="col-lg-2">
                    <label class="control-label">Número</label>
                    {!! Form::input('text','cheque[numero_cheque]',null,
                    ['class'=>'form-control','placeholder'=>'N° Cheque']) !!}
                </div>
                <div class="col-lg-2">
                    <label class="control-label">Banco</label>
                    {!! Form::select('cheque[banco_id]',  $load['bancos'],null,
                    ['class'=>'form-control','placeholder'=>'*** BANCO ***']) !!}
                </div>
                <div class="col-lg-2">
                    <label class="control-label">Data de Vencimento</label>
                    {!! Form::input('text','cheque[data_vencimento]',null,
                    ['class'=>'form-control date','placeholder'=>'Data de Vencimento']) !!}
                </div>
                <div class="col-lg-2">
                    <label class="control-label">Data de Pagamento</label>
                    {!! Form::input('text','cheque[data_pagamento]',null,
                    ['class'=>'form-control date','placeholder'=>'Data de Pagamento']) !!}
                </div>
                <div class="col-lg-2">
                    <label class="control-label">Valor</label>
                    {!! Form::input('text','cheque[valor]',null,
                    ['class'=>'form-control valorTira money','placeholder'=>'Valor']) !!}
                </div>
                <input type="hidden" name="cheque[forma_de_pagamento_id]" value="5">
            </div>
        </div>
    @endif


    @foreach($venda->contasAReceber->where('forma_de_pagamento_id',7) as $key => $item)
        {{--CHEQUE--}}
        <div class="tab-pane" role="tabpanel" id="tab7">
            {{dump($item->valor)}}
            <div class="cancelamentoValor" id="cancelados">
                {!! Form::input('text','teste',"R$ ".$item->decimalMoney($item->valor),
           ['class'=>'form-control valorTira money','placeholder'=>'Valor']) !!}
            </div>
        </div>
    @endforeach


</div>
