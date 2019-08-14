@extends('template.template')
@section('content')
    <!-- Page header -->
    <div class="heading-elements" style="text-align: right">
        <div class="heading-btn-group">
            <a href="{{ URL::to('/clientes/create') }}" class="btn btn-link btn-float has-text">
                <span> Adicionar Clientes</span></a>
        </div>
    </div>

    <div class="panel-heading">
        <h5 class="panel-title">Clientes</h5>
    </div>
    <hr>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="/"><i class="icon-home2 position-left"></i> Principal</a></li>
            <li class="active"><a href="/clientes">Clientes</a></li>
            <li class="active"><a href="/clientes">Produtos de Cliente</a></li>

        </ul>
    </div>
    <!-- /page header -->

    <!-- Conteúdo -->


    <div class="content table-responsive table-full-width">

        <table class="table datatable-export">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Referência</th>
                <th>Valor</th>
                <th class="text-center">Ações</th>
            </tr>
            </thead>
            <tbody>

            @foreach($produtos as $chave => $produto)
                <tr>
                    <td>{{ $produto->produto->nome }}</td>
                    <td>{{ $produto->produto->referencia}}</td>
                    <td>{{ $produto->produto->valor}}</td>

                    <td class="text-center">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-three-bars color"></i>
                                    <b class="caret hidden-sm hidden-xs"></b>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{url('clientes/' . $produto->id . '/produtos')}}"><i
                                                    class="icon-file-presentation2"></i>
                                            Gerar Invoice</a>
                                    </li>
                                    <li>
                                        <a href="{{url('clientes/' . $produto->id . '/servicos')}}"><i
                                                    class="icon-file-eye2"></i>
                                            Mostrar Invoice</a>
                                    </li>
                                    <li>
                                        <a href="{{url('clientes/' . $produto->id . '/edit')}}"><i
                                                    class="pe-7s-note"></i>
                                            Editar Produto</a>
                                    </li>
                                    <li>
                                        <a href="{{url('clientes/' . $produto ->id . '/delete')}}"><i
                                                    class="pe-7s-trash"></i>
                                            Excluir Produto</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

