<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Orcamento 1</title>
    <link rel="stylesheet" href="pdf/orcamentos/style.css" media="all"/>
</head>
<body>
<header class="clearfix">
    <div id="logo">
        <img src="pdf/orcamentos/logo.png">
    </div>
    <h1>ORÇAMENTO #{{$entity->id}}</h1>
    <div id="company" class="clearfix">
        <div>Company Name</div>
        <div>455 Foggy Heights,<br/> AZ 85004, US</div>
        <div>(602) 519-0450</div>
        <div><a href="{{$entity->funcionarios->email}}">{{$entity->funcionarios->email}}</a></div>
    </div>
    <div id="project">
        <div><span>Cliente</span> {{$entity->cliente->present}}</div>
        <div><span>Endereço</span> {{$entity->cliente->endereco}}</div>
        <div><span>Email</span> <a href="{{$entity->cliente->email}}">{{$entity->cliente->email}}</a></div>
        <div><span>Data Orc.</span> @date($entity->data_venda)</div>
        <div><span>Validade</span> {{$entity->validade_orcamento}}</div>
    </div>
</header>


<div id="notices">
    <div>Introdução:</div>
    <div class="notice">{{$entity->descricao}}</div>
</div>

<br><br>

<hr>

<br><br>
<main>
    <?php
    $servicos = $entity->invoices->where('produto_id', null);
    $produtos = $entity->invoices->where('servico_id', null);
    ?>

    @if(count($produtos))
        <table>
            <thead>
            <tr>
                <th class="service">PRODUTOS</th>
                <th class="desc">RERÊNCIA</th>
                <th>QTY</th>
                <th>PREÇO UNIT.</th>
                <th>TOTAL</th>
            </tr>
            </thead>
            <tbody>
            @foreach($produtos as $key => $item)
                @if($item->produto_id)
                    <tr>
                        <td class="service">{{$item->produto->nome}}</td>
                        <td class="desc">{{$item->produto->referencia}}</td>
                        <td class="unit">{{$item->quantidade}}</td>
                        <td class="qty">{{$item->valor/$item->quantidade}}</td>
                        <td class="total">{{$item->valor}}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @endif

    @if(count($servicos))

        <table>
            <thead>
            <tr>
                <th class="service">SERVICOS</th>
                <th class="desc">RERÊNCIA</th>
                <th>QTY</th>
                <th>PREÇO UNIT.</th>
                <th>TOTAL</th>
            </tr>
            </thead>
            <tbody>
            @foreach($servicos as $key => $item)
                @if($item->servico_id)
                    <tr>
                        <td class="service">{{$item->servico->nome}}</td>
                        <td class="desc">{{$item->servico->referencia}}</td>
                        <td class="unit">{{$item->quantidade}}</td>
                        <td class="qty">{{$item->valor/$item->quantidade}}</td>
                        <td class="total">{{$item->valor}}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @endif

    <table>
        <thead>
        </thead>
        <tbody>
        <tr>
            <td colspan="4">SUBTOTAL</td>
            <td class="total">{{$entity->valor_total}}</td>
        </tr>
        <tr>
            <td colspan="4">DESCONTOS/JUROS/TAXAS</td>
            <td class="total">R$ 0,00</td>
        </tr>
        <tr>
            <td colspan="4" class="grand total">TOTAL</td>
            <td class="grand total">{{$entity->valor_total}}</td>
        </tr>
        </tbody>

        <br><br>
        <div id="notices">
            <div>Formas de Pagamento:</div>
            <div class="notice">{{$entity->formas_pagamento}}</div>
        </div>


        <br><br>
        <div id="notices">
            <div>Orservações extras:</div>
            <div class="notice">{{$entity->descricao}}</div>
        </div>
        <br><br>
</main>
<footer>
    aqui entram as informações do rodapé :).
</footer>
</body>
</html>