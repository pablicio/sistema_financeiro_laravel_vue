@extends('template.template')
@section('content')
@section('page_title')
    <h2>
        Listagem dos usuários
    </h2>
@endsection

@if (Session::has('mensagem'))
    <div class="alert alert-sucess">{{ Session::get('mensagem') }}</div>
@endif
<div class="heading-btn-group">
    <a href="users/create" class="btn btn-success"><i
                class="icon-add text-primary"></i><span>Adicionar Usuários</span></a>
</div>

<table class="table table-hover">
    <tr>
        <th>Nome</th>
        <th>E-mail</th>
        <th width="200px">Ações</th>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                {{ Form::open(array('url' => 'painel/users/' . $user->id, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                <button type="link" class="delete"><i class="fa fa-trash"></i></button>
                {{ Form::close() }}

                <a href="{{url("/painel/permission_users/edit/".$user->id)}}">
                    <button class="add"><i class="glyphicon glyphicon-plus"></i></button>
                </a>

                <a href="{{url("/painel/users/$user->id/roles")}}">
                    <button class="permission"><i class="fa fa-unlock"></i></button>
                </a>
                <a href="{{url("/painel/users/$user->id/edit")}}">
                    <button class="edit"><i class="fa fa-pencil-square-o"></i></button>
                </a>
            </td>
    @endforeach
</table>
{!! $users->render() !!}

@endsection