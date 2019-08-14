@extends('template.template')
@section('content')
    <!-- Page header -->
    @include('shared.header', $paramns = [
        'btnNome' => 'Nova Venda',
        'nome' => 'Vendas de '. $cliente->present,
        'url' => '/vendas/'. $cliente->id.'/create',
        'breadcrum' => [
           [
                'nome' => 'Clientes',
                'url'  => '/clientes'
            ],
            [
                'nome' => 'Vendas de '. $cliente->present,
                'url'  => ''
            ]
            ]
     ])
    <!-- /page header -->

    <!-- Conteúdo -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <legend class="text-bold">Preencha os campos abaixo</legend>

            <div class="content table-responsive table-full-width">
                <table class="table datatable-export">
                    <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Validade</th>
                        <th>Previsão de Entrega</th>
                        <th>Data da Venda</th>
                        <th class="text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($vendas as $chave => $venda)
                        <tr>

                            <td>{{ $venda->descricao }}</td>
                            <td>{{ $venda->validade_venda}}</td>
                            <td>{{ $venda->previsao_entrega}}</td>
                            <td>@date($venda->data_venda)</td>

                            <td class="text-center">
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-three-bars color"></i>
                                            <b class="caret hidden-sm hidden-xs"></b>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{url('vendas/' . $venda->id . '/show')}}"><i
                                                            class="icon-eye"></i>
                                                    Ver Venda</a>
                                            </li>
                                            <li>
                                                <a href="{{url('vendas/' . $venda->id . '/edit')}}"><i
                                                            class="pe-7s-note"></i>
                                                    Editar Venda</a>
                                            </li>
                                            <li>
                                                <a href="{{url('vendas/' . $venda ->id . '/delete')}}"><i
                                                            class="pe-7s-trash"></i>
                                                    Excluir Venda</a>
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
    </div>
@endsection
