<?php namespace App\Http\Controllers\Relatorios;

use App\Http\Controllers\Controller;
use App\Projeto\Financeiro\ContasAPagar;
use App\Projeto\Fornecedores\Fornecedor;
use App\Projeto\Variaveis\Situacao;
use App\Projeto\Variaveis\TipoPagamento;
use Illuminate\Http\Request;

class ContasAPagarRelatorioController extends Controller
{
    public function index()
    {
//        $this->authorize('show', Contrato::class);

        $tipos_pagamentos = TipoPagamento::pluck('descricao', 'id');

        $fornecedores = Fornecedor::pluck('nome', 'id');

        $situacoes = Situacao::pluck('descricao', 'id');

        return view('relatorios.relatorios_contas_a_pagar.filter', compact('situacoes', 'tipos_pagamentos', 'fornecedores'));
    }

    public function view(Request $request)
    {
//        $this->authorize('show', Contrato::class);

        $contas_a_pagar = new ContasAPagar();

        if ($request->ajax()) {
            return $contas_a_pagar->datatableRelatorio($contas_a_pagar->dadosDatatableRelatorio($contas_a_pagar, $request));
        }

        $html = $this->getColunms(ContasAPagar::COLUMNS_OF_DATATABLE_RELATORIO);

        return view('relatorios/relatorios_contas_a_pagar/index', compact('html'));
    }
}
