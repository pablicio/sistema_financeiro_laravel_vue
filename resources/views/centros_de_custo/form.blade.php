@extends('template.template')
@section('content')
    <!-- Page header -->
    <div class="header">
        <div class="page-header page-header-default">
            <div class="page-header-content">
                <div class="page-title">
                    <h4>
                        <i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Projeto</span> -
                        {{isset($centros_de_custo) ? $bread = 'Atualização de Centros de Custos' : $bread = 'Cadastro de Centros de Custos' }}
                    </h4>
                </div>
            </div>

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="icon-home2 position-left"></i> Principal</a></li>
                <li class="breadcrumb-item"><a href="/centros_de_custos">Centros de Custos</a></li>
                <li class="breadcrumb-item active">{{$bread}}</li>
            </ol>

        </div>
    </div>
    <!-- /page header -->

    <!-- Form horizontal -->
    @if(isset($centros_de_custo))
        {{ Form::model($centros_de_custo, array('route' => array('centros_de_custo.update', $centros_de_custo->id),
        'class'=>'form-horizontal', 'method' => 'PUT',
        'id' => 'formExemplo','data-toggle' => 'validator', 'role' => 'form')) }}
    @else
        {{ Form::open(array('url' => '/centros_de_custo','class'=>'form-horizontal',
        'id' => 'formExemplo','data-toggle' => 'validator', 'role' => 'form')) }}
    @endif

    <div class="panel">
        <div class="content">
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
                                <label for="descricao" class="control-label">Descrição</label>
                                {!! Form::input('text','descricao',null,
                                ['id' => 'descricao','class'=>'form-control','placeholder'=>'Digite a descricao...','required',
                                'data-error' => 'Informe a descricao.']) !!}
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit"
                                class="btn btn-primary">{{isset($centros_de_custo) ? 'Atualizar' : 'Cadastrar' }} <i
                                    class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection('content')


