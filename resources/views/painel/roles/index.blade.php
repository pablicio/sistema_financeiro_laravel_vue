@extends('template.template')
@section('content')
@section('page_title')
    <h2>
        Listagem das Roles
    </h2>
@endsection

<div class="heading-btn-group">
    <a href="roles/create" class="btn btn-success"><i
                class="icon-add text-primary"></i><span>Adicionar Role</span></a>
</div>

<table class="table table-hover">
    <tr>
        <th>Nome</th>
        <th>Label</th>
        <th width="200px">Ações</th>
    </tr>

    @foreach($roles as $role)
        <tr>
            <td>{{$role->name}}</td>
            <td>{{$role->label}}</td>
            <td>
                {{ Form::open(array('url' => 'painel/roles/' . $role->id, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                <button type="link" class="delete"><i class="fa fa-trash"></i></button>
                {{ Form::close() }}


                <a href="{{url("/painel/permission_roles/create")}}">
                    <button class="add"><i class="glyphicon glyphicon-plus"></i></button>
                </a>

                <a href="{{url("/painel/roles/$role->id/permissions")}}">
                    <button class="permission"><i class="fa fa-unlock"></i></button>
                </a>
                <a href="{{url("/painel/roles/$role->id/edit")}}">
                    <button class="edit"><i class="fa fa-pencil-square-o"></i></button>
                </a>
            </td>
    @endforeach
</table>

@endsection