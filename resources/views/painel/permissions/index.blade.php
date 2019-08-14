@extends('template.template')
@section('content')
@section('page_title')
    <div class="col-lg-12">
        <h1 class="page-header">Listagem das Permissões</h1>
    </div>
@endsection

<div class="heading-btn-group">
    <a href="permissions/create" class="btn btn-success"><i
                class="icon-add text-primary"></i><span>Adicionar Permission</span></a>
</div>

<table class="table table-hover">
    <tr>
        <th>Nome</th>
        <th>Label</th>
        <th width="200px">Ações</th>
    </tr>

    @foreach($permissions as $permission)
        <tr>
            <td>{{$permission->name}}</td>
            <td>{{$permission->label}}</td>
            <td>
                {{ Form::open(array('url' => 'painel/permissions/' . $permission->id, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                <button type="link" class="delete"><i class="fa fa-trash"></i></button>
                {{ Form::close() }}

                <a href="{{url("/painel/roles/$permission->id/edit")}}">
                    <button class="add"><i class="glyphicon glyphicon-plus"></i></button>
                </a>

                <a href="{{url("/painel/permissions/$permission->id/roles")}}">
                    <button class="permission"><i class="fa fa-unlock"></i></button>
                </a>
                <a href="{{url("/painel/permissions/$permission->id/edit")}}">
                    <button class="edit"><i class="fa fa-pencil-square-o"></i></button>
                </a>
            </td>
    @endforeach
</table>
{{$permissions->render()}}

@endsection