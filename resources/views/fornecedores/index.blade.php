@extends('template.template')
@section('content')
    <!-- Page header -->
    @include('shared.header', $paramns = [
         'nome' => 'Fornecedores',
         'url' => '/fornecedores/create',
         'breadcrum' => [
             [
                 'nome' => 'Fornecedores',
                 'url'  => '/fornecedores'
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
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data de Nascimento</th>
                    <th>CPF / CNPJ</th>
                    <th>CEP</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>

                @foreach($fornecedores as $chave => $fornecedor)
                    <tr>
                        <td>{{ $fornecedor->present }}</td>
                        <td>{{ $fornecedor->email}}</td>
                        <td>@date($fornecedor->data_nascimento ? $fornecedor->data_nascimento:'')</td>
                        <td>{{ empty($fornecedor->cpf) ? $fornecedor->cnpj : $fornecedor->cpf }}</td>
                        <td>{{ $fornecedor->cep}}</td>
                        <td>{{ $fornecedor->endereco }}</td>
                        <td>{{ $fornecedor->endereco}}</td>
                        <td class="text-center">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-three-bars color"></i>
                                        <b class="caret hidden-sm hidden-xs"></b>

                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{url('fornecedores/' . $fornecedor->id . '/edit')}}"><i
                                                        class="pe-7s-note"></i>
                                                Editar Fornecedores</a>
                                        </li>
                                        <li>
                                            <a href="{{url('fornecedores/' . $fornecedor ->id . '/delete')}}"><i
                                                        class="pe-7s-trash"></i>
                                                Excluir Fornecedores</a>
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

