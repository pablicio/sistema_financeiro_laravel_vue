<?php namespace App\Http\Controllers;


use App\Helpers\EstruturaArray;
use App\Projeto\Financeiro\ContasAReceber;
use App\Projeto\Financeiro\Invoice;
use App\Projeto\Financeiro\Venda;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ContasAReceberController extends Controller
{


    public function index(Invoice $invoice, Request $request)
    {
        $this->authorize('show', ContasAReceber::class);

        $contas_a_receber = new ContasAReceber();

        if ($request->ajax()) {
            return $contas_a_receber->datatable($contas_a_receber->dadosDatatable($invoice->id));
        }

        $html = $this->getColunms(ContasAReceber::COLUMNS_OF_DATATABLE);

        return view('contas_a_receber.index', compact('html', 'invoice'));
    }

    public function create()
    {
//        $this->authorize('create', ContasAReceber::class);

        dd("OI");

        $load = ContasAReceber::loadFormFields();

        $array = EstruturaArray::estruturarPlanoDeContas($load['contas_contabeis']);

        return view('contas_a_receber.create', compact('invoice', 'formas_de_pagamento', 'bancos', 'cartoes', 'conciliacoes', 'array'));
    }


    public function store(Request $request)
    {
//        $this->customValidate($request->all() , new ContaContabilValidator());

        $venda = Venda::create($this->limpaArray([
            'funcionario_id' => Auth::user()->id,
            'cliente_id' => $request['cliente_id'],
            'conta_id' => $request['conta_id'],
            'forma_de_pagamento_id' => $request['forma_de_pagamento_id'],
            'data_venda' => date('Y-m-d'),
            'valor_total' => $request['valor'],
            'descricao' => "Ajuste Conciliação"
        ]));

        $invoice = $venda->invoices()->create([
            'cliente_id' => $request['cliente_id'],
            'valor' => $request['valor'],
        ]);

        $contas_a_receber = $venda->contasAReceber()->create([
            'forma_de_pagamento_id' => $request['forma_de_pagamento_id'],
            'cliente_id' => $request['cliente_id'],
            'conta_id' => $request['conta_id'],
            'valor' => $request['valor'],
            'data_vencimento' => $request['data_vencimento'],
            'data_pagamento' => $request['data_pagamento'],
            'descricao' => $request['descricao'],
        ]);

        if(isset($request['id_div'])){

            return redirect()->back()->with('data_session',$request['id_div'] ."_".$contas_a_receber->id."_recebimento");
        }
    }


    public function edit($id)
    {
        $this->authorize('update', ContasAReceber::class);

        $conta = new ContaContabil();

        $array = $conta->arrayFilhos($conta);

        $banco = Banco::pluck('nome', 'id');

        $cartao = Cartao::pluck('nome', 'id');

        $contas_a_receber = ContasAReceber::findOrFail($id);

        return view('contas_a_receber.edit', compact('contas_a_receber', 'array', 'banco', 'cartao'));
    }


    public function update($id, Request $request)
    {
        $this->customValidate($request->all(), new ContasAReceberValidator(), 'update');

        $contas_a_receber = ContasAReceber::findOrFail($id);

//        $request = $contas_a_receber->nularCampos($request);

        $contas_a_receber->createAfterPgto($contas_a_receber, $this->limpaArray($request));

        $contas_a_receber->update($request->all());

        return redirect()->to('admin/contas_a_receber/' . $request['invoice_id']);
    }

    public function contasAReceberDelete($id)
    {
        $this->authorize('destroy', ContasAReceber::class);

        ContasAReceber::findOrFail($id)->delete();

        return redirect()->back();
    }
}
