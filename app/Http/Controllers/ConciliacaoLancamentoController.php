<?php namespace App\Http\Controllers;

use App\Helpers\FluentInterface;
use App\Projeto\Financeiro\ContasAPagar;
use App\Projeto\Financeiro\ContasAReceber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class ConciliacaoLancamentoController extends Controller
{
    public $fluent;

    public function __construct()
    {
        $this->fluent = new FluentInterface();

    }

    public function lancadosPagamento(Request $request)
    {
        $query = $this->fluent
            ->select(['*'])
            ->from('contas_a_pagar')
            ->where("id NOT IN (select conta_pagar_id from conciliacoes_contas where conta_pagar_id is not null)")
            ->getQuery();

        $contas = DB::select($query);


        return Datatables::of(collect($contas))
            ->setRowId(function ($conta) {
                return 'Pagamento'.$conta->id;
            })
            ->addColumn('action', function ($pagamento) {
                return '<button data-dismiss="modal" 
                            value="' . $pagamento->id . '" 
                            class="btn btn-xs btn-primary btnPesquisarPagamento">
                            Selecionar
                        </button>';
            })
            ->make(true);
    }

    public function lancadosRecebimento(Request $request)
    {
        $query = $this->fluent
            ->select(['*'])
            ->from('contas_a_receber')
            ->where("id NOT IN (select conta_receber_id from conciliacoes_contas where conta_receber_id is not null)")
            ->getQuery();

        $contas = DB::select($query);

        return Datatables::of(collect($contas))
            ->setRowId(function ($conta) {
                return 'Recebimento'.$conta->id;
            })
            ->addColumn('action', function ($recebimento) {
                return '<button data-dismiss="modal" 
                            value="' . $recebimento->id . '" 
                            class="btn btn-xs btn-primary btnPesquisarRecebimento">
                            Selecionar
                        </button>';
            })
            ->make(true);
    }

    public function lancadosRecebimentoSelected(Request $request)
    {
//        $this->authorize('show', Centros_de_custo::class);

        return ContasAReceber::find($request->id);


    }

    public function lancadosPagamentoSelected(Request $request)
    {
//        $this->authorize('show', Centros_de_custo::class);

        return ContasAPagar::find($request->id);


    }
}
