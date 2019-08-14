@extends('template.template')
@section('content')
    <!-- Page header -->
    <div class="header">
        <div class="heading-elements" style="text-align: right">
            <div class="heading-btn-group">
                <a href="{{ URL::to('/centros_de_custo/create') }}" class="btn btn-link btn-float has-text">
                    <span> Adicionar Centros de Custos</span></a>
            </div>
        </div>

        <div class="panel-heading">
            <h4>
                <i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Projeto</span> -
                Centros de Custos
            </h4>
        </div>
        <hr>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="icon-home2 position-left"></i> Principal</a></li>
            <li class="breadcrumb-item active">Centros de Custos</li>
        </ol>
    </div>
    <!-- /page header -->

    <!-- Conteúdo -->
    <div class="panel">
        <div class="content table-responsive table-full-width">
            <table class="table datatable-export">
                <thead>
                <tr>
                    <th>Descrição</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>

                @foreach($centros_de_custo as $chave => $centro_de_custo)
                    <tr>
                        <td>{{ $centro_de_custo->descricao }}</td>
                        <td class="text-center">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-three-bars color"></i>
                                        <b class="caret hidden-sm hidden-xs"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{url('centros_de_custo/' . $centro_de_custo->id . '/edit')}}"><i
                                                        class="pe-7s-note"></i>
                                                Editar Centros</a>
                                        </li>
                                        <li>
                                            <a href="{{url('centros_de_custo/' . $centro_de_custo ->id . '/delete')}}"><i
                                                        class="pe-7s-trash"></i>
                                                Excluir Centros</a>
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
    </div>
@endsection

