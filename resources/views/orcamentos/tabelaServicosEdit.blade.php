<div class=" form-group calcular">
    <label class="control-label col-lg-2"></label>
    <table id="listasServicos" border="0">
        <tr>
            <th width="272">Serviços</th>
            <th width="272">Quantidade</th>
            <th width="272">Valor</th>
        </tr>


    <?php $cont = 0; ?>
        @foreach($orcamento->orcamentoItem as $key => $item)
            @if($item->servico_id)
                <tr class="{{"remove".$key}}">
                    <td>
                        {!! Form::select('servico-'.$cont.'[id]', $load['servicos'],isset($orcamento)? $item->servico->id:'',
                         ['class'=>'select2','placeholder'=>'*** Selecione o Produto ***']) !!}
                    </td>
                    <td>
                        {!! Form::input('text','servico-'.$cont.'[quantidade]',$item->quantidade,['class'=>'form-control quantidade','placeholder'=>'Quantidade']) !!}
                    </td>
                    <td>
                        {!! Form::input('text','servico-'.$cont.'[valor]','R$ '.$orcamento->decimalMoney($item->valor/$item->quantidade),['class'=>'form-control valorcc money','placeholder'=>'Valor']) !!}
                    </td>
                    <td>
                        <a href="#" class="remove_campo btn btn-danger" value="{{$item->id}}" id="{{"remove".$key}}">x</a>
                    </td>
                </tr>
                <?php $cont++; ?>
            @endif
        @endforeach
    </table>

    <input type="hidden" id="total_campos_servico" value="{{$cont}}">

    <div class="col-lg-6">
        <label class="control-label col-lg-2"></label>
        <label class="control-label col-lg-2"></label>
        <input type="button" class="btn btn-success" id="add_field_servico" value="+">
    </div>

    <div class="col-lg-6"><br><br><br>
        <label class="control-label">Desconto</label>
        <input class="form-control calcular" style="font-size: 30px; width: 440px" id="desconto">
        <label class="control-label">Valor Total: </label>
        <input class="form-control money" style="font-size: 30px; width: 440px" name="orcamento[valor_total]" readonly id="valor"><br>
        {{--<input type="button" class="btn btn-info calcular" value="Calcular">--}}
    </div>
</div>
