@extends('template.template')
@section('content')
@section('page_title')
    <h2>
        Adicionar Permission
    </h2>
@endsection

<!-- Mostra Mensagem -->
<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}

{{ Form::open(array('url' => 'painel/permissions')) }}

{!! Form::label('name','Nome') !!}
{!! Form::input('text','name',null,['class'=>'form-control','placeholder'=>'Nome']) !!}
<br>
{!! Form::label('label','Label') !!}
{!! Form::input('text','label',null,['class'=>'form-control','placeholder'=>'Label']) !!}
<br>

{!! Form::input('hidden','tipo',null) !!}

{{ Form::submit('Criar Permissão!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@endsection('content')
