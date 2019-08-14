<?php namespace App\Http\Controllers\Relatorios;


use App\Helpers\Consulta;
use App\Http\Controllers\Controller;

use App\Projeto\Clientes\Cliente;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class ClienteRelatorioController extends Controller
{
    public function index()
    {
//        $this->authorize('show', Contrato::class);

        $cliente = Cliente::pluck('nome', 'id');

        return view('relatorios.relatorios_clientes.filter', compact('cliente'));
    }

    public function view(Request $request)
    {
//        $this->authorize('show', Contrato::class);

        $clientes = new Cliente();


        if ($request->ajax()) {
            return $clientes->datatableRelatorio($clientes->dadosDatatableRelatorio($clientes, $request));
        }

        $html = $this->getColunms(Cliente::COLUMNS_OF_DATATABLE_RELATORIO);

        return view('relatorios/relatorios_clientes/index',compact('html'));

    }
}
