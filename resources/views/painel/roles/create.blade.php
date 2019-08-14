@extends('template.template')
@section('content')
@section('page_title')
    <h2>
        Adicionar Role
    </h2>
@endsection

<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}

{{ Form::open(array('url' => 'painel/roles')) }}

{!! Form::label('name','Nome') !!}
{!! Form::input('text','name',null,['class'=>'form-control','placeholder'=>'Nome']) !!}
<br>
{!! Form::label('label','Label') !!}
{!! Form::input('text','label',null,['class'=>'form-control','placeholder'=>'Label']) !!}
<br>
{{ Form::submit('Criar Role!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@endsection('content')
