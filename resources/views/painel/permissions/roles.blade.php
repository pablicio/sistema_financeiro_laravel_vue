@extends('template.template')
@section('content')
@section('page_title')
    <h2>
        Roles do {{$permissions->label}}
    </h2>
@endsection

<table class="table table-hover">
    <tr>
        <th>Nome</th>
        <th>Label</th>
        <th width="100px">Ações</th>
    </tr>

    @foreach($roles as $role)
        <tr>
            <td>{{$role->name}}</td>
            <td>{{$role->label}}</td>
            <td>
                <a href="{{url("/painel/permissions/$role->id/edit")}}" class="edit">
                    <i class="fa fa-pencil-square-o"></i>
                </a>

                <a href="{{url("/painel/role/$role->id/delete")}}" class="delete">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
    @endforeach
</table>

@endsection