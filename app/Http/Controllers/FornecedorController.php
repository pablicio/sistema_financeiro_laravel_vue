<?php namespace App\Http\Controllers;

use App\Helpers\AssociaTelefone;

use App\Projeto\Fornecedores\Fornecedor;
use App\Validators\FornecedorValidator;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{

    public function getFornecedores()
    {
//        $this->authorize('show', Fornecedor::class);

        return Fornecedor::get();
    }


    public function index(Request $request)
    {
//        $this->authorize('show', Fornecedor::class);

        $fornecedores = Fornecedor::get();

        return view('fornecedores.index', compact('fornecedores'));
    }

    public function create()
    {
//        $this->authorize('create', Fornecedor::class);

        $load = Fornecedor::loadFormFields();

        $cidades = [];

        return view('fornecedores.form', compact('load','cidades'));
    }

    public function store(Request $request)
    {
        $request = $this->limpaArray($request->all());

        $this->customValidate($request, new FornecedorValidator());

        $fornecedor = new Fornecedor();

        $fornecedor = $fornecedor->create($request);

        $fornecedor->telefones()->createMany($request['fornecedor_telefone']);

        return redirect()->to('/fornecedores');
    }

    public function edit($id)
    {
//        $this->authorize('update', Fornecedor::class);

        $fornecedor = Fornecedor::findOrFail($id);

        $fornecedor_telefone = $fornecedor->telefones()->get()->toArray();

        $cidades = $fornecedor->cidade->estado->cidades->pluck('nome','id');

        $load = $fornecedor->loadFormFields();

        return view('fornecedores.form', compact('fornecedor', 'fornecedor_telefone','load','cidades'));
    }

    public function update($id, Request $request)
    {
//        $this->customValidate($request->all(), new FornecedorValidator(), 'update');
        $request = $this->limpaArray($request->all());

        $fornecedor = Fornecedor::findOrFail($id);

        AssociaTelefone::associa($request['fornecedor_telefone'], $fornecedor);

        $fornecedor->update($request);

        return redirect()->to('fornecedores');
    }

    public function delete($id)
    {
//        $this->authorize('destroy', Fornecedor::class);

        Fornecedor::findOrFail($id)->delete();

        return redirect()->to('fornecedores');
    }
}
