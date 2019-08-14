@extends('template.template')
@section('content')

    @include('shared.header', $paramns = [
        'nome' => 'Serviços',
        'url' => '/servicos/create',
        'breadcrum' => [
            [
                'nome' => 'Serviços',
                'url'  => '/servicos'
            ]
        ]
    ])

    <!-- Conteúdo -->
    <div class="panel">

        <div class="content table-responsive table-full-width">
            <table class="table datatable-export">
                <thead>
                <tr>
                    <th>Referência</th>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>

                @foreach($servicos as $chave => $servico)
                    <tr>
                        <td>{{ $servico->referencia }}</td>
                        <td>{{ $servico->nome}}</td>
                        <td>{{ $servico->valor}}</td>

                        <td class="text-center">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-three-bars color"></i>
                                        <b class="caret hidden-sm hidden-xs"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{url('servicos/' . $servico->id . '/edit')}}"><i
                                                        class="pe-7s-note"></i>
                                                Editar Servicos</a>
                                        </li>
                                        <li>
                                            <a href="{{url('servicos/' . $servico ->id . '/delete')}}"><i
                                                        class="pe-7s-trash"></i>
                                                Excluir Servicos</a>
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

