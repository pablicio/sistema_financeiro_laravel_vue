@extends('template.template')
@section('content')

    @include('shared.header', $paramns = [
        'nome' => 'Contas a Pagar',
        'url' => '/contas_a_pagar/create',
        'breadcrum' => [
            [
                'nome' => 'Contas a Pagar',
                'url'  => '/contas_a_pagar'
            ]
            ]
     ])

    <!-- Conteúdo -->
    <div class="panel">
    <div class="content table-responsive table-full-width">
        <table class="table datatable-export">
            <thead>
            <tr>
                <th>Fornecedor</th>
                <th>Tipo de Despesa</th>
                <th>Data de Vencimento</th>
                <th>Data de Pagamento</th>
                <th>Valor</th>

                <th class="text-center">Ações</th>
            </tr>
            </thead>
            <tbody>

            @foreach($contas_a_pagar as $chave => $conta)
                <tr>
                  
                    <td>{{ $conta->fornecedores->nome}}</td>
                    <td>{{ $conta->tiposDespesas->descricao}}</td>
                    <td>@date($conta->data_vencimento ? $conta->data_vencimento:'')</td>
                    <td>@date($conta->data_pagamento ? $conta->data_pagamento:'')</td>
                    <td>{{"R$ ". $conta->valor }}</td>

                    <td class="text-center">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-three-bars color"></i>
                                    <b class="caret hidden-sm hidden-xs"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{url('/contas_a_pagar/' . $conta->id . '/edit')}}"><i
                                                    class="pe-7s-note"></i>
                                            Editar Contas a Pagar</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/contas_a_pagar/' . $conta ->id . '/delete')}}"><i
                                                    class="pe-7s-trash"></i>
                                            Excluir Contas a Pagar</a>
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

