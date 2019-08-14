@extends('template.template')
@section('content')
    <!-- Page header -->
    <?php isset($funcionarios) ?

        $paramns = [
            'nome' => 'Atualização de Funcionarios',
            'breadcrum' => [
                [
                    'nome' => 'Funcionarios',
                    'url' => '/funcionarios'
                ],
                [
                    'nome' => 'Atualização de Funcionarios',
                    'url' => ''
                ]
            ]
        ] :

        $paramns = [
            'nome' => 'Cadastro de Funcionarios',
            'breadcrum' => [
                [
                    'nome' => 'Funcionarios',
                    'url' => '/funcionarios'
                ],
                [
                    'nome' => 'Cadastro de Funcionarios',
                    'url' => ''
                ]
            ]
        ]?>

    @include('shared.header',$paramns)
    <!-- /page header -->

    <!-- Form horizontal -->
    @if(isset($funcionario))
        {{ Form::model($funcionario, array('route' => array('funcionarios.update', $funcionario->id),
        'class'=>'form-horizontal', 'method' => 'PUT','id' => 'formExemplo','data-toggle' => 'validator', 'role' => 'form')) }}
    @else
        {{ Form::open(array('url' => 'funcionarios','class'=>'form-horizontal',
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

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="nome" class="control-label">Nome</label>
                        {!! Form::input('text','nome',null,
                        ['id' => 'nome','class'=>'form-control form-control-danger','placeholder'=>'Digite o nome...','required',
                        'data-error' => 'Informe o nome.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
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
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="data_nascimento" class="control-label">Data de Nascimento</label>
                        <input id="data_nascimento" class="form-control date form-control-danger"
                               @if(isset($funcionario)) value="@date($funcionario->data_nascimento)"
                               @else value="" @endif
                               name="data_nascimento" required placeholder="Nascimento"
                               data-error="Informe a data de nascimento.">
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="endereco" class="control-label">Endereço</label>
                        {!! Form::input('text','endereco',null,
                        ['id' => 'endereco','required','class'=>'form-control form-control-danger',
                        'placeholder'=>'Endereço','data-error' => 'Informe o endereço.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="bairro" class="control-label">Bairro</label>
                        {!! Form::input('text','bairro',null,
                        ['id' => 'bairro','required','class'=>'form-control form-control-danger',
                        'placeholder'=>'Bairro','data-error' => 'Informe o bairro.']) !!}
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
                        isset($funcionario)? $funcionario->cidade->estado->id:'',
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
                         isset($funcionario)? $funcionario->cidade->id:'',
                         ['id' => 'cidade_id','required','class'=>'select2 form-control-danger',
                         'placeholder'=>'Selecione a Cidade'
                         ,'data-error' => 'Informe a cidade.']) !!}
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
                        ['id' => 'cep','required','class'=>'form-control cep  form-control-danger',
                        'placeholder'=>'CEP','data-error' => 'Informe o cep.']) !!}
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
                        ['id' => 'email','required','class'=>'form-control  form-control-danger',
                        'placeholder'=>'E-mail','data-error' => 'Informe o email ex: fulano@email.com.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="tipo_perfil_id" class="control-label">Tipo de Perfil</label>
                        {!! Form::select('tipo_perfil_id', $load['tipos_perfis'],null,
                            ['id' => 'tipo_perfil_id','required','class'=>'select2  form-control-danger',
                            'placeholder'=>'*** Selecione o Tipo de Perfil ***'
                            ,'data-error' => 'Informe o tipo de perfil.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors  form-control-feedback"></div>
                        </small>
                    </div>
                </div>
            </div>

            <legend class="text-bold">Telefones</legend>


            <div class="row">
                <div class="form-group">
                    <div class="col-md-10">
                        @if(isset($funcionario))
                            @foreach($funcionario_telefone as $i => $telefone)
                                {!! Form::input('text','funcionario_telefone[' . $telefone['id'] . '][telefone]', $telefone['telefone'],
                                ['class'=>'form-control fone','placeholder'=>'Telefone '. ($i + 1),
                                'style' => 'width:25%; display: inline-block; margin-right:25px;']) !!}
                            @endforeach
                            @for($i=1; $i <= (3 - count($funcionario_telefone)); $i++)
                                {!! Form::input('text','funcionario_telefone[' . $i . '][telefone]', null, ['class'=>'form-control fone',
                                'placeholder'=>'Telefone '.(count($funcionario_telefone) +$i),
                                'style' => 'width:25%; display: inline-block; margin-right:25px;']) !!}
                            @endfor
                        @else
                            @for($i=1; $i<4; $i++)
                                @for($i=1; $i<4; $i++)
                                    {!! Form::input('text','funcionario_telefone[][telefone]',null,['class'=>'form-control fone',
                                    'style' => 'width:25%; display: inline-block; margin-right:25px;','placeholder'=>'Telefone '.$i]) !!}
                                @endfor
                            @endfor
                        @endif
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="submit"
                        class="btn btn-primary">{{isset($funcionario) ? 'Atualizar' : 'Cadastrar' }}
                    <i
                            class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
    </div>
    {{ Form::close() }}

@endsection('content')

