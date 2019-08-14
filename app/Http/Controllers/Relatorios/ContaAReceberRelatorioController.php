<?php namespace App\Http\Controllers\Relatorios;


use App\Http\Controllers\Controller;
use App\Projeto\Clientes\Cliente;
use App\Projeto\Financeiro\ContasAReceber;
use App\Projeto\Variaveis\FormaPagamento;
use App\Projeto\Variaveis\Situacao;
use Illuminate\Http\Request;

class ContaAReceberRelatorioController extends Controller
{
    public function index()
    {
//        $this->authorize('show', Contrato::class);

        $clientes = Cliente::pluck('nome', 'id');

        $formas_de_pagamento = FormaPagamento::pluck('descricao', 'id');

        $situacoes = Situacao::pluck('descricao', 'id');

        return view('relatorios.relatorios_contas_a_receber.filter', compact('clientes', 'situacoes', 'formas_de_pagamento'));
    }

    public function view(Request $request)
    {
//        $this->authorize('show', Contrato::class);

        $contas_a_receber = new ContasAReceber();

        if ($request->ajax()) {
            return $contas_a_receber->datatableRelatorio($contas_a_receber->dadosDatatableRelatorio($contas_a_receber, $request));
        }

        $html = $this->getColunms(ContasAReceber::COLUMNS_OF_DATATABLE_RELATORIO);

        return view('relatorios/relatorios_contas_a_receber/index', compact('html'));
    }
}
