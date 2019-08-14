<?php namespace App\Http\Controllers;


use App\Helpers\EstruturaArray;
use App\Helpers\SelectCategoria;
use App\Projeto\Financeiro\ConciliacaoBancaria;
use App\Projeto\Financeiro\ConciliacaoOfx;
use App\Projeto\Financeiro\ContaBancaria;
use App\Projeto\Financeiro\ContasAPagar;
use App\Projeto\Financeiro\ContasAReceber;
use Illuminate\Http\Request;

class ConciliacaoBancariaController extends Controller
{

    public function filter()
    {
        $conta = ContaBancaria::get();

        return view('conciliacoes.filter',compact('conta'));
    }


    public function index()
    {
//        $this->authorize('show', ConciliacaoBancaria::class);

        $conta = ContaBancaria::get();

        $conciliacoes = ConciliacaoBancaria::paginate(10);

        return view('conciliacoes_bancarias.index', compact('conciliacoes', 'conta','data'));
    }




    public function create($id, Request $request)
    {
        $this->authorize('create', ConciliacaoBancaria::class);

        $conciliacoes_bancarias = ConciliacaoBancaria::find($id);

        $tipo = $conciliacoes_bancarias->getContaByTipo($conciliacoes_bancarias)[1];

        $contas = $conciliacoes_bancarias->queryDatatablesCreate($conciliacoes_bancarias,$tipo);

        if($request->ajax()) {
            return $conciliacoes_bancarias->datatableCreate($contas);
        }

        if ($tipo == ConciliacaoBancaria::TIPO_PAGAR) {

            $url = $_SERVER['HTTP_REFERER'];

            $html = $this->getColunms($contas[0]->getColumns());

            return view('conciliacoes_bancarias.conciliacaoPagamento', compact('html', 'id', 'tipo', 'url'));

        } else if ($tipo == ConciliacaoBancaria::TIPO_RECEBER) {

            $url = $_SERVER['HTTP_REFERER'];

            $html = $this->getColunms($contas[0]->getColumns());

            return view('conciliacoes_bancarias.conciliacaoRecebimento', compact('html', 'id', 'tipo', 'url'));

        }
    }

    public function import_ofx()
    {
//        $this->authorize('create', ConciliacaoBancaria::class);

        $conta = ContaBancaria::get();

        return view('conciliacoes/importOfx', compact('conta'));
    }


    public function conciliacoes(Request $request)
    {
//        $this->authorize('create', ConciliacaoBancaria::class);

//        $this->customValidate($request->all(), new ConciliacaoBancariaValidator(), 'filter');

        $array = array_except($request->input(), ['_token']);

        $conciliacoes = new ConciliacaoBancaria();

        $soma = $conciliacoes->sum('valor');

        $somaSistema = $conciliacoes
            ->join('conciliacoes_contas', 'conciliacoes_contas.conciliacao_id', '=', 'conciliacoes_bancarias.id')
            ->sum('valor');

        $conta = ContaBancaria::get();

        $data = ContasAPagar::get();

        $conciliacoes = $conciliacoes->where('situacao_id',ConciliacaoBancaria::STATUS_A_CONCILIAR)->paginate(4);

        $pagamento = ContasAPagar::loadFormFields();

        $recebimento = ContasAReceber::loadFormFields();

        $array = json_encode(EstruturaArray::estruturarPlanoDeContas($pagamento['contas_contabeis']));

        return view('conciliacoes/index',
            compact('conta', 'soma', 'somaSistema', 'data','conciliacoes','pagamento','recebimento','array'));
    }

    public function store(Request $request)
    {
//        $this->customValidate($request->all(), new ConciliacaoBancariaValidator(), 'ofx');


        $ofx = ConciliacaoBancaria::ofx($request->doc->path());

        $model = new ConciliacaoBancaria();

        $ofxObj = ConciliacaoOfx::create([
            'banco_id' => $request->banco_id,
            'ofx_name' => sha1(6),
            'balance' => $ofx->balance,
        ]);

        $model->insert($model->ofxRecordsFilter($ofx->statement->transactions, $request,$ofxObj->id));

        return redirect()->to(route('conciliacoes.ofx.list',compact('ofxObj')));

    }

    public function ofxList($ofx, Request $request)
    {
        $conciliacoes = new ConciliacaoBancaria();

        $somaSistema = $conciliacoes
            ->join('conciliacoes_contas', 'conciliacoes_contas.conciliacao_id', '=', 'conciliacoes_bancarias.id')
            ->sum('valor');

        $conciliacoes = $conciliacoes::where('ofx_id',$ofx)
            ->where('situacao_id',ConciliacaoBancaria::STATUS_A_CONCILIAR)->paginate(4);

        $ofx = ConciliacaoOfx::find($ofx);

        $soma = $ofx->balance;

        $pagamento = ContasAPagar::loadFormFields();

        $recebimento = ContasAReceber::loadFormFields();

        $array = json_encode(EstruturaArray::estruturarPlanoDeContas($pagamento['contas_contabeis']));


        return view('conciliacoes.index',
            compact('html', 'somaSistema','soma','conciliacoes','recebimento', 'pagamento', 'array'));

    }

    public function associate(Request $request)
    {
//        $this->customValidate($request->all(), new ConciliacaoBancariaValidator(), 'associar');

//        $this->authorize('update', ConciliacaoBancaria::class);

        $conciliacoes = ConciliacaoBancaria::find($request['conciliacao_id']);

        $associacoes = $conciliacoes->associaConciliacoes($request);

        $request['tipo'] ?
            $soma = ContasAReceber::whereIn('id', $request['contas'])->sum('valor') :
            $soma = ContasAPagar::whereIn('id', $request['contas'])->sum('valor');

        if ($soma == abs($conciliacoes->valor)) {

            $conciliacoes->conciliacoesConta()->createMany($associacoes);

            $conciliacoes->update(['situacao_id' => ConciliacaoBancaria::STATUS_CONCILIADO]);

            return redirect()->back();

        } else {

            return redirect()->back()
                ->withErrors("A Soma das contas selecionadas difere do valor a ser conciliado, escolha as contas corretas!");
        }
    }

    public function edit($id)
    {
        $this->authorize('update', ConciliacaoBancaria::class);

        $conciliacoes_bancarias = ConciliacaoBancaria::findOrFail($id);

        return view('conciliacoes_bancarias.edit', compact('conciliacoes_bancarias'));
    }

    public function update($id, Request $request)
    {
        $this->customValidate($request->all(), new ConciliacaoBancariaValidator(), 'update');

        ConciliacaoBancaria::findOrFail($id)->update($request->all());

        return redirect()->to('admin/conciliacoes_bancarias');
    }

    public function delete($id)
    {
        $this->authorize('destroy', ConciliacaoBancaria::class);

        ConciliacaoBancaria::findOrFail($id)->delete();

        return redirect()->to('admin/conciliacoes_bancarias');
    }
}
