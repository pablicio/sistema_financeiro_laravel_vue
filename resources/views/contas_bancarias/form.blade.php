@extends('template.template')
@section('content')
    <!-- Page header -->
    <?php isset($cliente) ?

        $paramns = [
            'nome' => 'Atualização de Contas Bancárias',
            'breadcrum' => [
                [
                    'nome' => 'Contas Bancárias',
                    'url' => '/contas_bancarias'
                ],
                [
                    'nome' => 'Atualização de Contas Bancárias',
                    'url' => ''
                ]
            ]
        ] :

        $paramns = [
            'nome' => 'Cadastro de Contas Bancárias',
            'breadcrum' => [
                [
                    'nome' => 'Contas Bancárias',
                    'url' => '/contas_bancarias'
                ],
                [
                    'nome' => 'Cadastro de Contas Bancárias',
                    'url' => ''
                ]
            ]
        ]?>

    @include('shared.header',$paramns)
    <!-- /page header -->
    <!-- Form horizontal -->
    @if(isset($conta_bancaria))
        {{ Form::model($conta_bancaria, array('route' => array('contas_bancarias.update', $conta_bancaria->id),
        'class'=>'form-horizontal', 'method' => 'PUT',
        'id' => 'formExemplo','data-toggle' => 'validator', 'role' => 'form')) }}
    @else
        {{ Form::open(array('url' => '/contas_bancarias','class'=>'form-horizontal',
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
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="agencia" class="control-label">Agência</label>
                        {!! Form::input('text','agencia',null,
                        ['id' => 'agencia','class'=>'form-control form-control-danger','placeholder'=>'Digite a agência...','required',
                        'data-error' => 'Informe a agência.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="conta" class="control-label">Conta</label>
                        {!! Form::input('text','conta',null,
                        ['id' => 'conta','class'=>'form-control form-control-danger','placeholder'=>'Digite a conta...','required',
                        'data-error' => 'Informe a conta.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="favorecido" class="control-label">Favorecido</label>
                        {!! Form::input('text','favorecido',null,
                        ['id' => 'favorecido','class'=>'form-control form-control-danger','placeholder'=>'Digite o favorecido...','required',
                        'data-error' => 'Informe o favorecido.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="banco_id" class="control-label">Banco</label>
                        {!! Form::select('banco_id', $load['bancos'],
                        isset($conta_bancaria)? $conta_bancaria->bancos->id:'',
                        ['id' => 'banco_id','required','class'=>'select2 form-control-danger',
                        'placeholder'=>'Selecione o Banco'
                        ,'data-error' => 'Informe o banco.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="submit"
                        class="btn btn-primary">{{isset($conta_bancaria) ? 'Atualizar' : 'Cadastrar' }}
                    <i
                            class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection('content')


