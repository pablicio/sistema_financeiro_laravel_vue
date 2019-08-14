<div class=" form-group calcular">
    <label class="control-label col-lg-2"></label>
    <table id="listasServicos" border="0">
        <tr>
            <th width="272">Serviços</th>
            <th width="272">Quantidade</th>
            <th width="272">Valor</th>
        </tr>
        <tr>
            <td>
                {!! Form::select('servico-0[id]', $load['servicos'],isset($orcamento)? $orcamento->servico->id:'',
                ['class'=>'select2','placeholder'=>'*** Selecione o Serviço ***']) !!}
            </td>
            <td>
                {!! Form::input('text','servico-0[quantidade]',1,['class'=>'form-control quantidade','placeholder'=>'Quantidade']) !!}
            </td>
            <td>
                {!! Form::input('text','servico-0[valor]',null,['class'=>'form-control valorcc money','placeholder'=>'Valor']) !!}
            </td>
        </tr>
    </table>
    <div>
        <input type="button" class="btn btn-success" id="add_field_servico" value="+">
    </div>
    <input type="hidden" id="total_campos_servico" value="{{1}}">

    <div class="col-lg-6"><br><br><br>
        <label class="control-label">Desconto</label>
        <input class="form-control calcular money" style="font-size: 30px; width: 440px" id="desconto">
        <label class="control-label">Valor Total: </label>
        <input class="form-control money" style="font-size: 30px; width: 440px" name="orcamento[valor_total]" readonly id="valor"><br>
        {{--<input type="button" class="btn btn-info calcular" value="Calcular">--}}
    </div>

    <br>

</div>
