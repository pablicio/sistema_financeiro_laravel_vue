<?php namespace App\Http\Controllers;



use App\Projeto\Financeiro\ContaBancaria;
use Illuminate\Http\Request;

class ContaBancariaController extends Controller
{
    public function index(Request $request)
    {
//        $this->authorize('show', ContaBancaria::class);

        $contas_bancarias = ContaBancaria::get();

        return view('contas_bancarias.index', compact('contas_bancarias'));
    }

    public function create()
    {
//        $this->authorize('create', ContaBancaria::class);

        $load = ContaBancaria::loadFormFields();

        return view('contas_bancarias.form', compact('load'));

    }

    public function store(Request $request)
    {
//        $this->customValidate($request->all(), new ContaBancariaValidator());

        ContaBancaria::create($this->limpaArray($request->all()));

        return redirect()->to('/contas_bancarias');
    }

    public function edit($id)
    {
//        $this->authorize('update', ContaBancaria::class);

        $conta_bancaria = ContaBancaria::findOrFail($id);

        $load = ContaBancaria::loadFormFields();

        return view('contas_bancarias.form', compact('conta_bancaria','load'));
    }

    public function update($id, Request $request)
    {
//        $this->customValidate($request->all(), new ContaBancariaValidator(), 'update');

        ContaBancaria::findOrFail($id)->update($this->limpaArray($request->all()));

        return redirect()->to('/contas_bancarias');
    }



    public function delete($id)
    {
//        $this->authorize('destroy', ContaBancaria::class);

        ContaBancaria::findOrFail($id)->delete();

        return redirect()->to('/contas_bancarias');
    }
}
