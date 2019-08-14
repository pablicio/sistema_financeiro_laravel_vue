<?php namespace App\Http\Controllers;


use App\Helpers\AssociaTelefone;
use App\Helpers\EstruturaArray;
use App\Projeto\Financeiro\ContasAPagar;
use App\Projeto\Contas_a_pagar\Contas_a_pagar;
use App\Validators\Contas_a_pagarValidator;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ContasAPagarController extends Controller
{


    public function index(Request $request)
    {
//        $this->authorize('show', Contas_a_pagar::class);

        $contas_a_pagar = ContasAPagar::get();

        return view('contas_a_pagar.index', compact('contas_a_pagar'));
    }

    public function create()
    {
//        $this->authorize('create', Contas_a_pagar::class);

        $load = ContasAPagar::loadFormFields();

//        $array = EstruturaArray::estruturarPlanoDeContas($load['contas_contabeis']);

        return view('contas_a_pagar.form', compact('load','array'));
    }

    public function store(Request $request)
    {
//        $this->customValidate($request->all(), new ContasAPagarController());

        $request = $this->limpaArray($request->input());

        $contas_a_pagar = new ContasAPagar();

        $contas_a_pagar = $contas_a_pagar->create($request);

        if(!empty($request['data_pagamento'])){

            $contas_a_pagar->createAfterPgto($contas_a_pagar,$request);

        }

        if(isset($request['id_div'])){

            return redirect()->back()->with('data_session',$request['id_div'] ."_".$contas_a_pagar->id."_pagamento");
        }
    }

    public function edit($id)
    {
//        $this->authorize('update', Contas_a_pagar::class);

        $contas_a_pagar = ContasAPagar::findOrFail($id);

        $load = $contas_a_pagar->loadFormFields();

        $array = EstruturaArray::estruturarPlanoDeContas($load['contas_contabeis']);

        return view('contas_a_pagar.form', compact('contas_a_pagar', 'array','load'));
    }

    public function update($id, Request $request)
    {
//        $this->customValidate($request->all(), new Contas_a_pagarValidator(), 'update');
        $request = $this->limpaArray($request->input());

        $contas_a_pagar = ContasAPagar::findOrFail($id);

        $contas_a_pagar->update($request);

        return redirect()->to('contas_a_pagar');
    }

    public function delete($id)
    {
//        $this->authorize('destroy', Contas_a_pagar::class);

        ContasAPagar::findOrFail($id)->delete();

        return redirect()->to('contas_a_pagar');
    }
}
