<?php namespace App\Http\Controllers;

//use App\Entities\Estado;
//use App\Entities\Funcionarios\Funcionario;
//use App\Entities\Funcionarios\FuncionarioTelefone;
//use App\Entities\Funcionarios\TipoPerfil;
//use App\Helpers\AssociaTelefone;
use App\Helpers\AssociaTelefone;
use App\Projeto\Financeiro\Invoice;
use App\Projeto\Financeiro\OrcamentoItem;
use App\Projeto\Financeiro\OrcamentoRecebimento;
use App\Projeto\Funcionarios\Funcionario;
use App\Validators\FuncionarioValidator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class InvoiceController extends Controller
{


    public function index(Request $request)
    {
//        $this->authorize('show', Funcionario::class);

        $funcionarios = Funcionario::get();

        return view('funcionarios.index', compact('funcionarios'));
    }

    public function create()
    {
//        $this->authorize('create', Funcionario::class);

        $load = Funcionario::loadFormFields();

        $cidades = [];

        return view('funcionarios.form', compact('load', 'cidades'));
    }

    public function store(Request $request)
    {
        $this->customValidate($request->all(), new FuncionarioValidator());

        $funcionario = new Funcionario();

        $funcionario = $funcionario->create($request->all());

        $funcionario->telefones()->createMany($request['funcionario_telefone']);

        return redirect()->to('admin/funcionarios');
    }

    public function edit($id)
    {
//        $this->authorize('update', Funcionario::class);

        $funcionario = Funcionario::findOrFail($id);

        $funcionario_telefone = $funcionario->telefones()->get()->toArray();

        $cidades = $funcionario->cidade->estado->cidades->pluck('nome', 'id');

        $load = $funcionario->loadFormFields();

        return view('funcionarios.form', compact('funcionario', 'funcionario_telefone', 'load', 'cidades'));
    }

    public function update($id, Request $request)
    {
//        $this->customValidate($request->all(), new FuncionarioValidator(), 'update');

        $funcionario = Funcionario::findOrFail($id);

        AssociaTelefone::associa($request['funcionario_telefone'], $funcionario);

        $funcionario->update($request->all());

        return redirect()->to('funcionarios');
    }

    public function delete($id)
    {
//        $this->authorize('destroy', Funcionario::class);

        OrcamentoItem::findOrFail($id)->delete();

        return redirect()->to('funcionarios');
    }

    public function deleteItem(Request $request)
    {
//        $this->authorize('destroy', Funcionario::class);

        $itemOrcamento = Invoice::findOrFail($request->id);


//        $array = [
//            'orcamento_id' => $itemOrcamento->orcamento_id,
//            'cliente_id' => $itemOrcamento->cliente_id,
//            'data_vencimento' => Carbon::now(),
//            'data_pagamento' => Carbon::now(),
//            'forma_de_pagamento_id' => 7,
//            'valor' => (-$itemOrcamento->valor),
//        ];
//
//        $recebimento = OrcamentoRecebimento::create($array);

        $itemOrcamento->delete();

        return response()->json();
    }

}
