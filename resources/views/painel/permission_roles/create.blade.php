@extends('template.template')
@section('content')
@section('page_title')
    <div class="col-lg-12">
        <h1 class="page-header">Adicionar Permissões da Role</h1>
    </div>
@endsection

{{ Form::open(array('url' => 'painel/permission_roles')) }}

{!! Form::label('role_id','Role') !!}
{!! Form::select('role_id', $roles,null,['class'=>'form-control','placeholder'=>'*** Selecione o Role ***']) !!}

@foreach($permissions as $key => $permission)
    <h3>{{strtoupper($key)}}</h3>
    @foreach($permission as $item)
        <label style="display: inline;">
            <input type="checkbox" name="permissions[]" value="{{ $item->id }}"/>
            {{ $item->label }}
        </label>
    @endforeach
@endforeach
<div class="text-right">
    <button type="submit" class="btn btn-primary">Cadastrar <i
                class="icon-arrow-right14 position-right"></i></button>
</div>
{{ Form::close() }}

@endsection
