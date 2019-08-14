@extends('template.template')
@section('content')
    <!-- Page header -->
    @include('shared.header', $paramns = [
        'nome' => 'Contas Bancárias',
        'url' => '/contas_bancarias/create',
        'breadcrum' => [
            [
                'nome' => 'Contas Bancárias',
                'url'  => '/contas_bancarias'
            ]
            ]
     ])
    <!-- /page header -->

    <!-- Conteúdo -->
    <div class="panel">
        <div class="content table-responsive table-full-width">
            <table class="table datatable-export">
                <thead>
                <tr>
                    <th>Banco</th>
                    <th>Agência</th>
                    <th>Conta</th>
                    <th>Favorecido</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($contas_bancarias as $conta_bancaria)
                    <tr>
                        <td>{{ $conta_bancaria->bancos->nome }}</td>
                        <td>{{ $conta_bancaria->agencia }}</td>
                        <td>{{ $conta_bancaria->conta }}</td>
                        <td>{{ $conta_bancaria->favorecido}}</td>

                        <td class="text-center">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-three-bars color"></i>
                                        <b class="caret hidden-sm hidden-xs"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{url('contas_bancarias/' . $conta_bancaria->id . '/edit')}}"><i
                                                        class="pe-7s-note"></i>
                                                Editar Contas Bancárias</a>
                                        </li>
                                        <li>
                                            <a href="{{url('contas_bancarias/' . $conta_bancaria ->id . '/delete')}}"><i
                                                        class="pe-7s-trash"></i>
                                                Excluir Contas Bancárias</a>
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

