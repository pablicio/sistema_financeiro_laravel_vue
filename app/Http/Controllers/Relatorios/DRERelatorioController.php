<?php namespace App\Http\Controllers\Relatorios;


use App\Http\Controllers\Controller;
use App\Projeto\Financeiro\ContaContabil;
use Illuminate\Http\Request;

class DRERelatorioController extends Controller
{
    public function index()
    {
//        $this->authorize('show', Contrato::class);

        return view('relatorios.relatorios_dre.filter');
    }

    public function view(Request $request)
    {
//        $this->authorize('show', Contrato::class);
        $conta = new ContaContabil();

        $teste = $conta->estruturarPlanoDeContas($conta->consultaRecursiva());

        $array = json_encode($conta->estruturarPlanoDeContas($conta->consultaRecursiva()));

        return view('relatorios/relatorios_dre/index',compact('conta','conta_contabil_valor','array','request'));
    }
}
