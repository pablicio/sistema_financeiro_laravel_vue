@extends('template.template')
@section('content')
@section('page_title')
    <h2>
        Permissões do {{$roles->name}}
    </h2>
@endsection

<table class="table table-hover">
    <tr>
        <th>Nome</th>
        <th>Label</th>
        <th width="100px">Ações</th>
    </tr>

    @foreach($permissions as $permision)
        <tr>
            <td>{{$permision->name}}</td>
            <td>{{$permision->label}}</td>
            <td>
                <a href="{{url("/painel/roles/$permision->id/edit")}}" class="edit">
                    <i class="fa fa-pencil-square-o"></i>
                </a>

                <a href="{{url("/painel/permision/$permision->id/delete")}}" class="delete">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
    @endforeach
</table>
@endsection