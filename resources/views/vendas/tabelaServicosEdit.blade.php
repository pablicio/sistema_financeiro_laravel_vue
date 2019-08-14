<div class=" form-group calcular">
    <label class="control-label col-lg-2"></label>
    <table id="listasServicos" border="0">
        <tr>
            <th width="272">Serviços</th>
            <th width="272">Quantidade</th>
            <th width="272">Valor</th>
        </tr>


    <?php $cont = 0; ?>
        @foreach($venda->invoices as $key => $item)
            @if($item->servico_id)
                <tr class="{{"remove".$key}}">
                    <td>
                        {!! Form::select('servico-'.$cont.'[id]', $load['servicos'],isset($venda)? $item->servico->id:'',
                         ['class'=>'form-control','placeholder'=>'*** Selecione o Produto ***']) !!}
                    </td>
                    <td>
                        {!! Form::input('text','servico-'.$cont.'[quantidade]',$item->quantidade,['class'=>'form-control quantidade','placeholder'=>'Quantidade']) !!}
                    </td>
                    <td>
                        {!! Form::input('text','servico-'.$cont.'[valor]','R$ '.$venda->decimalMoney($item->valor/$item->quantidade),['class'=>'form-control valorcc money','placeholder'=>'Valor']) !!}
                    </td>
                    <td>
                        <a href="#" class="remove_campo btn btn-danger" value="{{$item->id}}" id="{{"remove".$key}}">x</a>
                    </td>
                </tr>
                <?php $cont++; ?>
            @endif
        @endforeach
    </table>
    <div>
        <input type="button" class="btn btn-success" id="add_field_servico" value="+">
    </div>

    <input type="hidden" id="total_campos_servico" value="{{$cont}}">

    <div class="col-lg-6"><br><br><br>
        <label class="control-label">Desconto</label>
        <input class="form-control calcular" style="font-size: 30px; width: 440px" id="desconto">
        <label class="control-label">Valor Total: </label>
        <input class="form-control money" style="font-size: 30px; width: 440px" name="venda[valor_total]" readonly id="valor"><br>
        {{--<input type="button" class="btn btn-info calcular" value="Calcular">--}}
    </div>
</div>
