@extends('template.template')
@section('content')
@section('page_title')
    <div class="col-lg-12">
        <h1 class="page-header">Listagem dos usuários</h1>
    </div>

@endsection


<table class="table table-hover">
    <tr>
        <th>Nome</th>
        <th>Label</th>
        <th width="150px">Ações</th>
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
                <a href="{{url("/painel/roles/$role->id/permissions")}}">
                    <button class="permission"><i class="fa fa-unlock"></i></button>
                </a>
                <a href="{{url("/painel/roles/$role->id/edit")}}">
                    <button class="edit"><i class="fa fa-pencil-square-o"></i></button>
                </a>
            </td>
    @endforeach
</table>


<nav>
    <ul class="pagination">
        <li>
            <a href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
            <a href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>

@endsection