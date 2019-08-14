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
            <li class="active"><a href="/clientes">Servicos de Cliente</a></li>

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




            @foreach($servicos as $chave => $servico)



                <tr>
                    <td>{{ $servico->servico->nome }}</td>
                    <td>{{ $servico->servico->referencia}}</td>
                    <td>{{ $servico->servico->valor}}</td>

                    <td class="text-center">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-three-bars color"></i>
                                    <b class="caret hidden-sm hidden-xs"></b>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{url('clientes/' . $servico->id . '/servicos')}}"><i
                                                    class="icon-file-presentation2"></i>
                                            Gerar Invoice</a>
                                    </li>
                                    <li>
                                        <a href="{{url('clientes/' . $servico->id . '/servicos')}}"><i
                                                    class="icon-file-eye2"></i>
                                            Mostrar Invoice</a>
                                    </li>
                                    <li>
                                        <a href="{{url('clientes/' . $servico->id . '/edit')}}"><i
                                                    class="pe-7s-note"></i>
                                            Editar Servico</a>
                                    </li>
                                    <li>
                                        <a href="{{url('clientes/' . $servico ->id . '/delete')}}"><i
                                                    class="pe-7s-trash"></i>
                                            Excluir Servico</a>
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

