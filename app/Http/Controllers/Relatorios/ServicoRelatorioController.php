<?php namespace App\Http\Controllers\Relatorios;


use App\Helpers\Consulta;
use App\Http\Controllers\Controller;
use App\Projeto\Servicos\Servico;
use Illuminate\Http\Request;

class ServicoRelatorioController extends Controller
{
    public function index()
    {
//        $this->authorize('show', Contrato::class);

        $servico = Servico::pluck('nome', 'id');

        return view('relatorios.relatorios_servicos.filter', compact('servico'));
    }

    public function view(Request $request)
    {
//        $this->authorize('show', Contrato::class);

        $servicos = new Servico();

        if ($request->ajax()) {
            return $servicos->datatableRelatorio($servicos->dadosDatatableRelatorio($servicos, $request));
        }

        $html = $this->getColunms(Servico::COLUMNS_OF_DATATABLE_RELATORIO);

        return view('relatorios/relatorios_servicos/index',compact('html'));
    }
}
