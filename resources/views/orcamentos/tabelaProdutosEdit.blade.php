<div class=" form-group calcular">
    <label class="control-label col-lg-2"></label>
    <table id="listasProdutos" border="0">
        <tr>
            <th width="272">Produtos</th>
            <th width="272">Quantidade</th>
            <th width="272">Valor</th>
        </tr>

        <?php $cont = 0; ?>
        @foreach($orcamento->orcamentoItem as $key => $item)
            @if($item->produto_id)

                <tr class="{{"remove".$key}}">
                    <td>
                        {!! Form::select('produto-'.$cont.'[id]', $load['produtos'],isset($orcamento)? $item->produto->id:'',
                         ['class'=>'select2','placeholder'=>'*** Selecione o Produto ***']) !!}
                    </td>
                    <td>
                        {!! Form::input('text','produto-'.$cont.'[quantidade]',$item->quantidade,['class'=>'form-control quantidade','placeholder'=>'Quantidade']) !!}
                    </td>

                    <td>
                        {!! Form::input('text','produto-'.$cont.'[valor]','R$ '.$orcamento->decimalMoney($item->valor/$item->quantidade),['class'=>'form-control valorcc money','placeholder'=>'Valor']) !!}
                    </td>
                    <td>
                        <a href="#" class="remove_campo btn btn-danger"  value="{{$item->id}}" id="{{"remove".$key}}">x</a>
                    </td>
                </tr>
                <?php $cont++; ?>
            @endif
        @endforeach

        <input type="hidden" id="total_campos_produto" value="{{$cont}}">

    </table>
    <div class="col-lg-6">
        <label class="control-label col-lg-2"></label>
        <label class="control-label col-lg-2"></label>
        <input type="button" class="btn btn-success" id="add_field_produto" value="+">
    </div>
</div>
