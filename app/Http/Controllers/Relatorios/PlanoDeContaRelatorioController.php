<?php namespace App\Http\Controllers\Relatorios;


use App\Helpers\Consulta;
use App\Helpers\EstruturaArray;
use App\Helpers\FluentInterface;
use App\Http\Controllers\Controller;
use App\Projeto\Clientes\Cliente;
use App\Projeto\Financeiro\ContaContabil;
use App\Projeto\Financeiro\ContaContabilValor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanoDeContaRelatorioController extends Controller
{
    public function index()
    {
//        $this->authorize('show', Contrato::class);

        return view('relatorios.relatorios_planos_de_contas.filter');
    }

    public function view(Request $request)
    {
//        $this->authorize('show', Contrato::class);

        $conta = new ContaContabil();

        $array = json_encode($conta->estruturarPlanoDeContas($conta->consultaRecursiva()));

        return view('relatorios/relatorios_planos_de_contas/index',
            compact('conta','array','request','conta_contabil_valor'));

    }
}
