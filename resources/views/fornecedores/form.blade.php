@extends('template.template')
@section('content')
    <!-- Page header -->
    <?php isset($fornecedores) ?

        $paramns = [
            'nome' => 'Atualização de Fornecedores',
            'breadcrum' => [
                [
                    'nome' => 'Fornecedores',
                    'url' => '/fornecedores'
                ],
                [
                    'nome' => 'Atualização de Fornecedores',
                    'url' => ''
                ]
            ]
        ] :

        $paramns = [
            'nome' => 'Cadastro de Fornecedores',
            'breadcrum' => [
                [
                    'nome' => 'Fornecedores',
                    'url' => '/fornecedores'
                ],
                [
                    'nome' => 'Cadastro de Fornecedores',
                    'url' => ''
                ]
            ]
        ]?>

    @include('shared.header',$paramns)

    <!-- /page header -->

    <!-- Form horizontal -->
    @if(isset($fornecedor))
        {{ Form::model($fornecedor, array('route' => array('fornecedores.update', $fornecedor->id),
        'class'=>'form-horizontal', 'method' => 'PUT',
        'id' => 'formExemplo','data-toggle' => 'validator', 'role' => 'form')) }}
    @else
        {{ Form::open(array('url' => 'fornecedores','class'=>'form-horizontal',
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
            <div style="text-align: right">
                <label for="pessoa" class="control-label">Tipo de Pessoa </label>
                @if(isset($fornecedor))
                    <input id="pessoa" type="checkbox" class="switch pessoas"
                           data-on-text="Física" data-off-text="Jurídica" data-on-color="info"
                           data-off-color="default"
                           @if($fornecedor->cpf)checked="checked"@endif>
                @else
                    <input id="pessoa" type="checkbox" class="switch pessoas"
                           data-on-text="Física" data-off-text="Jurídica" data-on-color="info"
                           data-off-color="default"
                           checked="checked">
                @endif
            </div>

            <div id="fisica">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="nome" class="control-label">Nome</label>
                            {!! Form::input('text','nome',null,
                            ['id' => 'nome','class'=>'form-control  form-control-danger',
                            'placeholder'=>'Digite o nome...','required',
                            'data-error' => 'Informe o nome.']) !!}
                            <small class="form-text text-muted">
                                <div class="help-block with-errors form-control-feedback"></div>
                            </small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="cpf" class="control-label">CPF</label>
                            {!! Form::input('text','cpf',null,
                            ['id' => 'cpf','class'=>'form-control cpf form-control-danger','placeholder'=>'CPF',
                            'required','data-error' => 'Informe o cpf.']) !!}
                            <small class="form-text text-muted">
                                <div class="help-block with-errors form-control-feedback"></div>
                            </small>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="rg" class="control-label">RG</label>
                            {!! Form::input('text','rg',null,
                            ['id' => 'rg','class'=>'form-control rg form-control-danger','placeholder'=>'RG',
                            'required','data-error' => 'Informe o rg.']) !!}
                            <div class="help-block with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="data_nascimento" class="control-label">Data de Nascimento</label>
                            <input id="data_nascimento" class="form-control date form-control-danger"
                                   @if(isset($fornecedor)) value="@date($fornecedor->data_nascimento)"
                                   @else value="{{null}}" @endif
                                   name="data_nascimento" required placeholder="Nascimento"
                                   data-error="Informe a data de nascimento.">
                            <small class="form-text text-muted">
                                <div class="help-block with-errors form-control-feedback"></div>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div id="juridica" style="display: none">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="razao_social" class="control-label">Razão Social</label>
                            {!! Form::input('text','razao_social',null,
                            ['id' => 'razao_social','class'=>'form-control form-control-danger',
                            'placeholder'=>'Digite a razão social...',
                            'data-error' => 'Informe a razão social.']) !!}
                            <small class="form-text text-muted">
                                <div class="help-block with-errors form-control-feedback"></div>
                            </small>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="cnpj" class="control-label">CNPJ</label>
                            {!! Form::input('text','cnpj',null,
                            ['id' => 'cnpj','class'=>'form-control form-control-danger','placeholder'=>'Digite o cnpj...',
                            'data-error' => 'Informe o cnpj.']) !!}
                            <small class="form-text text-muted">
                                <div class="help-block with-errors form-control-feedback"></div>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="endereco" class="control-label">Endereço</label>
                        {!! Form::input('text','endereco',null,
                        ['id' => 'endereco','class'=>'form-control form-control-danger','placeholder'=>'Endereço',
                        'required','data-error' => 'Informe o endereço.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="bairro" class="control-label">Bairro</label>
                        {!! Form::input('text','bairro',null,
                        ['id' => 'bairro','class'=>'form-control bairro form-control-danger','placeholder'=>'Bairro',
                        'required','data-error' => 'Informe o bairro.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="cep" class="control-label">CEP</label>
                        {!! Form::input('text','cep',null,
                        ['id' => 'cep','class'=>'form-control cep form-control-danger','placeholder'=>'CEP',
                        'required','data-error' => 'Informe o cep.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="estado" class="control-label">Estado</label>
                        {!! Form::select('estado', $load['estados'],
                        isset($fornecedor)? $fornecedor->cidade->estado->id:'',
                        ['id' => 'estado','required','class'=>'select2 form-control-danger',
                        'placeholder'=>'Selecione o Estado'
                        ,'data-error' => 'Informe o estado.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="cidade_id" class="control-label">Cidade</label>
                        {!! Form::select('cidade_id',$cidades,
                         isset($fornecedor)? $fornecedor->cidade->id:'',
                         ['id' => 'cidade_id','required','class'=>'select2 form-control-danger',
                         'placeholder'=>'Selecione a Cidade'
                         ,'data-error' => 'Informe a cidade.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        {!! Form::input('email','email',null,
                        ['id' => 'email','required','class'=>'form-control form-control-danger',
                        'placeholder'=>'E-mail','data-error' => 'Informe o email ex: fulano@email.com.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
                <div class="col-lg-1"></div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="tipo_fornecedor_id" class="control-label">Tipo de Perfil</label>
                        {!! Form::select('tipo_fornecedor_id', $load['tipos_fornecedores'],null,
                            ['id' => 'tipo_fornecedor_id','required','class'=>'select2 form-control-danger',
                            'placeholder'=>'*** Selecione o tipo de fornecedor ***'
                            ,'data-error' => 'Informe o tipo de fornecedor.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label class="control-label">Observação</label>
                        <textarea rows="4" cols="4" class="form-control" name="observacao"
                                  placeholder="Observação"></textarea>
                    </div>
                </div>
            </div>

            <legend class="text-bold">Telefones</legend>


            <div class="row">
                <div class="form-group">
                    <div class="col-md-10">
                        @if(isset($fornecedor))
                            @foreach($fornecedor_telefone as $i => $telefone)
                                {!! Form::input('text','fornecedor_telefone[' . $telefone['id'] . '][telefone]', $telefone['telefone'],
                                ['class'=>'form-control fone','placeholder'=>'Telefone '. ($i + 1),
                                'style' => 'width:18%; display: inline-block; margin-right:25px;']) !!}
                            @endforeach
                            @for($i=1; $i <= (4 - count($fornecedor_telefone)); $i++)
                                {!! Form::input('text','fornecedor_telefone[' . $i . '][telefone]', null, ['class'=>'form-control fone',
                                'placeholder'=>'Telefone '.(count($fornecedor_telefone) +$i),
                                'style' => 'width:18%; display: inline-block; margin-right:25px;']) !!}
                            @endfor

                        @else
                            @for($i=1; $i<5; $i++)
                                @for($i=1; $i<5; $i++)
                                    {!! Form::input('text','fornecedor_telefone[][telefone]',null,['class'=>'form-control fone',
                                    'style' => 'width:18%; display: inline-block; margin-right:25px;','placeholder'=>'Telefone '.$i]) !!}
                                @endfor
                            @endfor
                        @endif
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="submit"
                        class="btn btn-primary">{{isset($fornecedor) ? 'Atualizar' : 'Cadastrar' }} <i
                            class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection('content')

@push('scripts')
<script src="/js/pessoas.js"></script>
@endpush


