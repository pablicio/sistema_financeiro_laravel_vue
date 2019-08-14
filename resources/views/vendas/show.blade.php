@extends('template.template')
@section('content')


    <!-- Page header -->
    <div class="header">
        <div class="page-header">
            <div class="page-header-content">
                <br><br>
                <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Projeto</span> -
                        Vizualização de Vendas</h4>
                    <hr>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Principal</a></li>
                        <li class="breadcrumb-item"><a href="/clientes">Clientes</a></li>
                        <li class="breadcrumb-item"><a href="invoice_template.html">Vendas</a></li>
                        <li class="breadcrumb-item active">Vizualização de Vendas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
<div class="panel">
    <div class="content">

        <!-- Invoice template -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h5 class="panel-title">Confira os dados da venda</h5>
                <br>
                <div class="heading-elements">
                    <a type="link" class="" href="{{'/vendas/'.$venda->id.'/printVenda'}}">
                        <i class="icon-printer position-left"></i>
                        Imprimir
                    </a>
                </div>
                <br>
            </div>


            <div class="panel-body no-padding-bottom">
                <div class="row">
                    <div class="col-sm-6 content-group">
                        <img src="/js/lais.jpg" class="content-group mt-10" alt="" style="width: 120px;">
                        <ul class="list-condensed list-unstyled">
                            <li>Lais Lousa LTDA</li>
                            <li>Arrojado Lisboa</li>
                            <li>888-555-2311</li>
                        </ul>
                    </div>

                    <div class="col-sm-6 content-group">
                        <div class="invoice-details">
                            <h5 class="text-uppercase text-semibold">VENDA #{{$venda->id}}</h5>
                            <ul class="list-condensed list-unstyled">
                                <li>Data da venda: <span
                                            class="text-semibold">@date($venda->data_venda)</span></li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-9 content-group">
                        <span class="text-muted">Venda para:</span>
                        <ul class="list-condensed list-unstyled">
                            <li><h5>{{$venda->cliente->present}}</h5></li>
                            <li><span class="text-semibold">{{$venda->cliente->present}}</span></li>
                            <li>{{$venda->cliente->endereco}}</li>
                            <li>{{$venda->cliente->cidade->nome}}</li>
                            <li>{{$venda->cliente->cidade->estado->nome}}</li>
                            <li>{{$venda->cliente->cep}}</li>
                            <li><a href="#">{{$venda->cliente->email}}</a></li>
                        </ul>
                    </div>

                    <div class="col-md-6 col-lg-3 content-group">
                        <span>Detalhes de pagamento</span>
                        <p class="text-muted">{{$venda->formas_pagamento}}</p>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-lg">
                    <thead>
                    <tr>
                        <th>Produtos</th>
                        <th class="col-sm-1">Referência</th>
                        <th class="col-sm-1">Quantidade</th>
                        <th class="col-sm-1">Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($venda->invoices as $key => $item)
                        @if($item->produto_id)
                            <tr>
                                <td>
                                    <h6 class="no-margin">{{$item->produto->nome}}</h6>
                                </td>
                                <td>
                                    <h6 class="no-margin">{{$item->produto->referencia}}</h6>
                                </td>
                                <td>{{$item->quantidade}}</td>
                                <td><span class="text-semibold">R$ {{$item->valor}}</span></td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <hr>
            <br>

            <div class="table-responsive">
                <table class="table table-lg">
                    <thead>
                    <tr>
                        <th>Serviços</th>
                        <th class="col-sm-1">Referência</th>
                        <th class="col-sm-1">Quantidade</th>
                        <th class="col-sm-1">Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($venda->invoices as $key => $item)
                        @if($item->servico_id)
                            <tr>
                                <td>
                                    <h6 class="no-margin">{{$item->servico->nome}}</h6>
                                </td>
                                <td>
                                    <h6 class="no-margin">{{$item->servico->referencia}}</h6>
                                </td>
                                <td>{{$item->quantidade}}</td>
                                <td><span class="text-semibold">R$ {{$item->valor}}</span></td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <hr>
            <br>

            <div class="panel-body">
                <div class="row invoice-payment">
                    <div class="col-sm-7">
                        <div class="content-group">
                            <h6>Pessoa Autorizada</h6><br>
                            <div class="mb-15 mt-15">
                                <img src="/js/kkk.png" class="display-block"
                                     style="width: 150px;" alt="">
                            </div>

                            <ul class="list-condensed list-unstyled text-muted">
                                <li>{{$venda->funcionarios->nome}}</li>
                                <li>2269 Elba Lane</li>
                                <li>Paris, France</li>
                                <li>888-555-2311</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="content-group">
                            <h6>Total due</h6>
                            <div class="table-responsive no-border">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th>Subtotal:</th>
                                        <td class="text-right">R$ {{$venda->valor_total}}</td>
                                    </tr>
                                    <tr>
                                        <th>Tax: <span class="text-regular">(25%)</span></th>
                                        <td class="text-right">R$ 0,00</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td class="text-right text-primary"><h5 class="text-semibold">
                                                R$ {{$venda->valor_total}}</h5></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-right">
                                <a type="link" href="{{'/vendas/'.$venda->id.'/envioVenda'}}"
                                   class="btn btn-primary"><b><i
                                                class="icon-paperplane"></i></b> Enviar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <h6>Informações relevantes da venda</h6><br>
                <p class="text-muted">{{$venda->descricao}}</p>
            </div>
        </div>
        <!-- /invoice template -->


    </div>
</div>
    <!-- /content area -->




@endsection

