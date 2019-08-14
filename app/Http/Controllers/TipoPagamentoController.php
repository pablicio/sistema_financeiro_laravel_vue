<?php namespace App\Http\Controllers;

use App\Projeto\Variaveis\SubTipoPagamento;
use App\Projeto\Variaveis\TipoPagamento;


class TipoPagamentoController extends Controller
{
    public function getTiposPagamentos()
    {
        return TipoPagamento::get();
    }

    public function getSubTiposPagamentos($id)
    {
        return SubTipoPagamento::where('tipo_pagamento_id', $id)->get();
    }
}
