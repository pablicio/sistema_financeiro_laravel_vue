@extends('template.template')
@section('content')

    @include('shared.header', $paramns = [
    'nome' => 'Clientes',
    'url' => '/clientes/create',
    'breadcrum' => [
        [
            'nome' => 'Clientes',
            'url'  => ''
        ]
        ]
    ])

    <!-- Conteúdo -->
    <div class="panel">
        <div class="content table-responsive table-full-width">

            <table class="table datatable-export">
                <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Email</th>
                    <th>Data de Nascimento</th>
                    <th>CPF / CNPJ</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>

                @foreach($clientes as $chave => $cliente)
                    <tr>
                        <td>{{ $cliente->present }}</td>
                        <td>{{ $cliente->email}}</td>
                        <td>@date($cliente->data_nascimento ? $cliente->data_nascimento : '')</td>
                        <td>{{ empty($cliente->cpf) ? $cliente->cnpj : $cliente->cpf }}</td>
                        <td>{{ $cliente->endereco }}</td>
                        <td>{{ $cliente->bairro}}</td>
                        <td class="text-center">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">

                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-three-bars color"></i>
                                        <b class="caret hidden-sm hidden-xs"></b>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{url('vendas/' . $cliente->id . '/clienteVendas')}}"><i
                                                        class="icon-cart"></i>
                                                Vendas</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{url('orcamentos/' . $cliente->id . '/clienteOrcamentos')}}"><i
                                                        class="icon-cart"></i>
                                                Orçamentos</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{url('clientes/' . $cliente->id . '/edit')}}"><i
                                                        class="icon-cart"></i>
                                                Editar Clientes</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{url('clientes/' . $cliente ->id . '/delete')}}"><i
                                                        class="icon-cart"></i>
                                                Excluir Clientes</a>
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
