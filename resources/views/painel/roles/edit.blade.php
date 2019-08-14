@extends('template.template')
@section('content')
@section('page_title')
    <h2>
        Editar: {{ $roles->name }}
    </h2>
@endsection
<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}

{{ Form::model($roles, array('route' => array('roles.update', $roles->id), 'method' => 'PUT')) }}

{!! Form::label('name','Nome') !!}
{!! Form::input('text','name',null,['class'=>'form-control','placeholder'=>'Nome']) !!}
<br>
{!! Form::label('label','Label') !!}
{!! Form::input('text','label',null,['class'=>'form-control','placeholder'=>'Label']) !!}
<br>
{{ Form::submit('Editar Role!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@endsection
