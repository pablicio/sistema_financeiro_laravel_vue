<?php namespace App\Http\Controllers;


use App\Helpers\EstruturaArray;
use App\Projeto\Financeiro\ContaContabil;
use App\Validators\ContaContabilValidator;
use App\Validators\ContaContabilValorValidator;
use App\Validators\ContasAPagarValidator;
use App\Validators\ContasAReceberValidator;
use Illuminate\Http\Request;


class ContaContabilController extends Controller
{

    public function arrayEstruturado()
    {
        $contas_contabeis = ContaContabil::all()->toArray();

        $array = EstruturaArray::estruturarPlanoDeContas($contas_contabeis);

        return $array;
    }

    public function index(Request $request)
    {
//        $this->authorize('show', Servico::class);

        $contas_contabeis = ContaContabil::all()->toArray();

//        $array = EstruturaArray::estruturarPlanoDeContas($contas_contabeis);

        return view('contas_contabeis.index', compact('contas_contabeis', 'array'));
    }

    public function create()
    {
//        $this->authorize('create', Servico::class);

        $contas_contabeis = ContaContabil::all()->toArray();

//        $array = EstruturaArray::estruturarPlanoDeContas($contas_contabeis);

        return view('contas_contabeis.form', compact('array'));
    }

    public function store(Request $request)
    {
        $this->customValidate($request->all(), new ContaContabilValidator([]));

        ContaContabil::create($this->limpaArray($request->all()));

        return redirect()->back();
    }

    public function edit($id)
    {
//        $this->authorize('update', Servico::class);

        $contas_contabeis = ContaContabil::get();

        $array = EstruturaArray::estruturarPlanoDeContas($contas_contabeis->toArray());

        $contas_contabeis = $contas_contabeis->find($id);

        return view('contas_contabeis.form', compact('contas_contabeis','array'));
    }

    public function update($id, Request $request)
    {
//        $rulesUpdate = [
//            'nome' => 'unique:conta_contabil,nome,' . $id,
//        ];

        $this->customValidate($request->all(), new ContaContabilValidator([]),'update');

        ContaContabil::findOrFail($id)->update($this->limpaArray($request->all()));

        return redirect()->to('contas_contabeis');
    }

    public function delete($id)
    {
//        $this->authorize('destroy', Servico::class);

        $this->customValidate(['conta_id' => $id], new ContaContabilValidator([]), 'delete');

        $conta = ContaContabil::findOrFail($id);

        $temAssociado = $conta->whereIn('conta_id',[$id])->where('deleted_at',null)->get();

        if (count($temAssociado)) {

            return redirect()->to('/contas_contabeis')->withErrors('Essa categoria é pai de outras categorias, não pode ser excluída!!');

        } else {

            ContaContabil::findOrFail($id)->delete();

            return redirect()->to('/contas_contabeis');
        }
    }
}
