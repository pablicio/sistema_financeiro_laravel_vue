<div class=" form-group calcular">
    <label class="control-label col-lg-2"></label>
    <table id="listasProdutos" border="0">
        <tr>
            <th width="272">Produtos</th>
            <th width="272">Quantidade</th>
            <th width="272">Valor</th>
        </tr>
        <tr>
            <td>
                {!! Form::select('produto-0[id]', $load['produtos'],isset($venda)? $venda->produto->id:'',
                 ['class'=>'form-control estados','placeholder'=>'*** Selecione o Produto ***']) !!}
            </td>
            <td>
                {!! Form::input('text','produto-0[quantidade]',null,['class'=>'form-control quantidade','placeholder'=>'Quantidade']) !!}
            </td>
            <td>
                {!! Form::input('text','produto-0[valor]',null,['class'=>'form-control valorcc money','placeholder'=>'Valor']) !!}
            </td>
        </tr>
    </table>

    <div> <input type="button" class="btn btn-success" id="add_field_produto" value="+"></div>

    <input type="hidden" id="total_campos_produto" value="{{1}}">

</div>
