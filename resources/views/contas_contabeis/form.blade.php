@extends('template.template')
@section('content')
    <!-- Page header -->
    <?php isset($cliente) ?

        $paramns = [
            'nome' => 'Atualização de Contas Contábeis',
            'breadcrum' => [
                [
                    'nome' => 'Contas Contábeis',
                    'url' => '/contas_contabeis'
                ],
                [
                    'nome' => 'Atualização de Contas Contábeis',
                    'url' => ''
                ]
            ]
        ] :

        $paramns = [
            'nome' => 'Cadastro de Contas Contábeis',
            'breadcrum' => [
                [
                    'nome' => 'Contas Contábeis',
                    'url' => '/contas_contabeis'
                ],
                [
                    'nome' => 'Cadastro de Contas Contábeis',
                    'url' => ''
                ]
            ]
        ]?>

    @include('shared.header',$paramns)
    <!-- /page header -->

    <!-- Form horizontal -->
    @if(isset($contas_contabeis))
        {{ Form::model($contas_contabeis, array('route' => array('contas_contabeis.update', $contas_contabeis->id),
        'class'=>'form-horizontal', 'method' => 'PUT',
        'id' => 'formExemplo','data-toggle' => 'validator', 'role' => 'form')) }}
    @else
        {{ Form::open(array('url' => '/contas_contabeis','class'=>'form-horizontal',
        'id' => 'formExemplo','data-toggle' => 'validator', 'role' => 'form')) }}
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

            @if(isset($contas_contabeis))
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="nome" class="control-label">Nome</label>
                            {!! Form::input('text','nome',null,
                            ['id' => 'nome','class'=>'form-control form-control-danger','placeholder'=>'Digite o Nome...','required',
                            'data-error' => 'Informe o nome.']) !!}
                            <small class="form-text text-muted">
                                <div class="help-block with-errors form-control-feedback"></div>
                            </small>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="nome" class="control-label">Nome</label>
                            {!! Form::input('text','nome',null,
                            ['id' => 'nome','class'=>'form-control form-control-danger','placeholder'=>'Digite o Nome...','required',
                            'data-error' => 'Informe o nome.']) !!}
                            <small class="form-text text-muted">
                                <div class="help-block with-errors form-control-feedback"></div>
                            </small>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-4">
                        <label for="conta_id" class="control-label">Categoria Pai</label>
                        <div class="form-group">
                            {{--                                @include('shared.select',compact('array'))--}}
                        </div>
                    </div>
                </div>
            @endif

            <div class="text-right">
                <button type="submit"
                        class="btn btn-outline-primary">{{isset($contas_contabeis) ? 'Atualizar' : 'Cadastrar' }} <i
                            class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection


