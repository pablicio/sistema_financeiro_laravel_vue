<?php namespace App\Http\Controllers\Relatorios;


use App\Http\Controllers\Controller;
use App\Projeto\Produtos\Produto;
use Illuminate\Http\Request;

class ProdutoRelatorioController extends Controller
{
    public function index()
    {
//        $this->authorize('show', Contrato::class);

        $produto = Produto::pluck('nome', 'id');

        return view('relatorios.relatorios_produtos.filter', compact('produto'));
    }

    public function view(Request $request)
    {
//        $this->authorize('show', Contrato::class);

        $produtos = new Produto();

        if ($request->ajax()) {
            return $produtos->datatableRelatorio($produtos->dadosDatatableRelatorio($produtos, $request));
        }

        $html = $this->getColunms(Produto::COLUMNS_OF_DATATABLE_RELATORIO);

        return view('relatorios/relatorios_produtos/index', compact('html'));
    }
}
