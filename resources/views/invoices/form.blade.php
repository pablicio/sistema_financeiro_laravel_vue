@extends('templates.template')
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4>
                    <i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Guardebem</span> -
                    {{isset($cliente) ? $bread = 'Atualização de Clientes' : $bread = 'Cadastro de Clientes' }}
                </h4>
                </h4>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="/"><i class="icon-home2 position-left"></i> Principal</a></li>
                <li class="active"><a href="/admin/clientes">Listagem de Clientes</a></li>
                <li class="active"><a
                            @if(isset($cliente)) href="{{'/admin/clientes/'.$cliente->id.'/edit'}}"
                            @else href="/admin/clientes/create"
                            @endif>{{$bread}}</a></li>
            </ul>
        </div>
    </div>
    <!-- /page header -->
    <!-- Form horizontal -->
    @if(isset($cliente))
        {{ Form::model($cliente, array('route' => array('clientes.update', $cliente->id),
        'class'=>'form-horizontal', 'method' => 'PUT')) }}
    @else
        {{ Form::open(array('url' => 'admin/clientes','class'=>'form-horizontal')) }}
    @endif
    <div class="content">
        <!-- Mostra Mensagem -->
        @if (Session::has('mensagem'))
            <div class="alert alert-info">{{ Session::get('mensagem') }}</div>
        @endif
    <!-- if there are creation errors, they will show here -->
        @if($errors->count() > 0)
            <div class="alert alert-danger">
                {{ HTML::ul($errors->all()) }}
            </div>
        @endif
        <div class="panel panel-flat">
            <div class="panel-body">
                <legend class="text-bold">Preencha os campos abaixo</legend>

                <div class="form-group ">
                    <label class="control-label col-lg-2">Tipo de Pessoa: Física /
                        Jurídica</label>
                    <div class="radio col-lg-10">
                        <label>
                            <input type="radio" name="pessoa" class="styled pessoas" value="fisica"
                                   checked="checked">
                            Física
                        </label>
                    </div>
                    <div class="radio col-lg-10">
                        <label>
                            <input type="radio" name="pessoa" value="juridica" class="styled pessoas">
                            Jurídica
                        </label>
                    </div>
                </div>

                <div class="form-group" id="fisica">
                    <label class="control-label col-lg-2">Nome / CPF / RG / Nascimento</label>

                    <div class="col-lg-3">
                        {!! Form::input('text','nome',null,['class'=>'form-control','autofocus','placeholder'=>'Nome']) !!}
                    </div>

                    <div class="col-lg-2">
                        {!! Form::input('text','cpf',null,['class'=>'form-control cpf','placeholder'=>'CPF']) !!}
                    </div>

                    <div class="col-lg-2">
                        {!! Form::input('text','rg',null,['class'=>'form-control','placeholder'=>'RG']) !!}
                    </div>

                    <div class="col-md-2">
                        <input class="form-control date" @if(isset($cliente)) value="@date($cliente->data_nascimento)"
                               @else value="" @endif
                               name="data_nascimento" placeholder="Nascimento">

                    </div>
                </div>

                <div class="form-group" id="juridica" style="display: none">
                    <label class="control-label col-lg-2">Razão Social / CNPJ</label>
                    <div class="col-lg-3">
                        {!! Form::input('text','razao_social',null,['class'=>'form-control','placeholder'=>'Razão Social']) !!}
                    </div>

                    <div class="col-lg-3">
                        {!! Form::input('text','cnpj',null,['class'=>'form-control cnpj','placeholder'=>'CNPJ']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Endereço / Bairro / Cep</label>
                    <div class="col-lg-3">
                        {!! Form::input('text','endereco',null,['class'=>'form-control','placeholder'=>'Endereço']) !!}
                    </div>
                    <div class="col-lg-3">
                        {!! Form::input('text','bairro',null,['class'=>'form-control','placeholder'=>'Bairro']) !!}
                    </div>
                    <div class="col-lg-3">
                        {!! Form::input('text','cep',null,['class'=>'form-control cep','placeholder'=>'Cep']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Estado / Cidade / Email</label>
                    <div class="col-lg-3">
                        {!! Form::select('estado', $load['estados'],isset($cliente)? $cliente->cidade->estado->id:''
                        , ['class'=>'select2 estados','placeholder'=>'*** Selecione o Estado ***']) !!}
                    </div>
                    <div class="col-lg-3">
                        {!! Form::select('cidade_id', $cidades, isset($cliente)? $cliente->cidade->id:'', ['class'=>'select2 cidades',
                        'placeholder'=>'*** Selecione a Cidade ***']) !!}
                    </div>
                    <div class="col-lg-3">
                        {!! Form::input('text','email',null,['class'=>'form-control','autofocus','placeholder'=>'E-mail']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Profissão / Origem / Convênio</label>
                    <div class="col-lg-3">
                        {!! Form::select('profissao_id',  $load['profissoes'],null,['class'=>'select2',
                        'placeholder'=>'*** Selecione a Profissão ***']) !!}
                    </div>
                    <div class="col-lg-3">
                        {!! Form::select('origem_id',  $load['origens'],null,['class'=>'select2',
                        'placeholder'=>'*** Selecione a Origem ***']) !!}
                    </div>
                    <div class="col-lg-3">
                        {!! Form::select('convenio_id',  $load['convenios'],null,['class'=>'select2',
                        'placeholder'=>'*** Selecione o Convênio ***']) !!}
                    </div>
                </div>

                <div class="form-group ">
                    <label class="control-label col-lg-2">Contribuinte ICMS</label>
                    <div class="radio col-lg-10">
                        <label>
                            <input type="radio" name="contribuinte_icms" class="styled" value=1
                                   checked="checked">
                            Sim
                        </label>
                    </div>

                    <div class="radio col-lg-10">
                        <label>
                            <input type="radio" name="contribuinte_icms" value=0 class="styled">
                            Não
                        </label>
                    </div>
                </div>

                <input type="hidden" name="unidade_id" value="{{Auth::user()->unidade->id}}">

                <div class="form-group">
                    <label class="control-label col-lg-2">Observação</label>
                    <div class="col-lg-6">
                        <textarea rows="4" cols="4" class="form-control" name="observacao"
                                  placeholder="Observação"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Telefones</label>
                    <div class="col-md-10">
                        @if(isset($cliente))
                            @foreach($cliente_telefone as $i => $telefone)
                                {!! Form::input('text','cliente_telefone[' . $telefone['id'] . '][telefone]', $telefone['telefone'],
                                ['class'=>'form-control fone','placeholder'=>'Telefone '. ($i + 1),
                                'style' => 'width:21%; display: inline-block; margin-right:25px;']) !!}
                            @endforeach
                            @for($i=1; $i <= (4 - count($cliente_telefone)); $i++)
                                {!! Form::input('text','cliente_telefone[' . $i . '][telefone]', null, ['class'=>'form-control fone',
                                'placeholder'=>'Telefone '.(count($cliente_telefone) +$i),
                                'style' => 'width:21%; display: inline-block; margin-right:25px;']) !!}
                            @endfor
                        @else
                            @for($i=1; $i<5; $i++)
                                {!! Form::input('text','cliente_telefone[][telefone]',null,
                                ['class'=>'form-control fone','style' => 'width:21%; display: inline-block; margin-right:25px;',
                                'placeholder'=>'Telefone '.$i]) !!}
                            @endfor
                        @endif
                    </div>
                </div>

                <legend class="text-bold">Cadastro do Contador</legend>

                <div class="form-group">
                    <label class="control-label col-lg-2">Nome / E-mail / Telefone</label>
                    <div class="col-lg-3">
                        {!! Form::input('text','contador[nome_contador]',null,['class'=>'form-control','autofocus',
                        'placeholder'=>'Nome do Contador']) !!}
                    </div>
                    <div class="col-lg-3">
                        {!! Form::input('text','contador[email_contador]',null,['class'=>'form-control','autofocus',
                        'placeholder'=>'E-Mail do Contador']) !!}
                    </div>
                    <div class="col-lg-3">
                        {!! Form::input('text','contador[telefone_contador]',null,['class'=>'form-control fone','autofocus',
                        'placeholder'=>'Telefone do Contador']) !!}
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">{{isset($cliente) ? 'Atualizar' : 'Cadastrar' }} <i
                                class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}

@endsection('content')


