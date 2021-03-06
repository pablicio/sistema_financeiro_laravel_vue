@extends('template.template')
@section('content')

    <?php isset($servico) ?

        $paramns = [
            'nome' => 'Atualização de Serviços',
            'breadcrum' => [
                [
                    'nome' => 'Serviços',
                    'url'  => '/servicos'
                ],
                [
                    'nome' => 'Atualização de Serviços',
                    'url'  => '/servicos/'.$servico->id.'/edit'
                ]
            ]
        ] :

        $paramns = [
            'nome' => 'Cadastro de Serviços',
            'breadcrum' => [
                [
                    'nome' => 'Serviços',
                    'url'  => '/servicos'
                ],
                [
                    'nome' => 'Cadastro de Serviços',
                    'url'  => '/servicos/create'
                ]
            ]
        ]?>

    @include('shared.header',$paramns)

    <!-- Form horizontal -->
    @if(isset($servico))
        {{ Form::model($servico, array('route' => array('servicos.update', $servico->id),
        'class'=>'form-horizontal', 'method' => 'PUT',
        'id' => 'formExemplo','data-toggle' => 'validator', 'role' => 'form')) }}
    @else
        {{ Form::open(array('url' => '/servicos','class'=>'form-horizontal',
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
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="referencia" class="control-label">Referência</label>
                        {!! Form::input('text','referencia',null,
                        ['id' => 'referencia','class'=>'form-control form-control-danger','placeholder'=>'Digite a referencia...','required',
                        'data-error' => 'Informe a referencia.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="valor" class="control-label">Valor</label>
                        {!! Form::input('text','valor',null,
                        ['id' => 'valor','class'=>'form-control form-control-danger','placeholder'=>'Digite o valor...','required',
                        'data-error' => 'Informe o valor.']) !!}
                        <small class="form-text text-muted">
                            <div class="help-block with-errors form-control-feedback"></div>
                        </small>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">{{isset($servico) ? 'Atualizar' : 'Cadastrar' }}
                    <i
                            class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
    </div>

    {{ Form::close() }}

@endsection('content')


