<?php namespace App\Http\Controllers;

use App\Helpers\AssociaTelefone;
use App\Projeto\Clientes\Cliente;
use App\Projeto\Clientes\ClienteProduto;
use App\Projeto\Clientes\ClienteServico;
use App\Validators\ClienteValidator;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function index(Request $request)
    {
//        $this->authorize('show', Cliente::class);

        $clientes = Cliente::get();

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
//        $this->authorize('create', Cliente::class);

        $load = Cliente::loadFormFields();

        $cidades = [];

        return view('clientes.form', compact('load','cidades'));
    }

    public function store(Request $request)
    {
        $request = $this->limpaArray($request->all());

        $this->customValidate($request, new ClienteValidator());

        $cliente = new Cliente();

        $cliente = $cliente->create($request);

        $cliente->telefones()->createMany($request['cliente_telefone']);

        return redirect()->to('/clientes');
    }

    public function edit($id)
    {
//        $this->authorize('update', Cliente::class);

        $cliente = Cliente::findOrFail($id);

        $cliente_telefone = $cliente->telefones()->get()->toArray();

        $cidades = $cliente->cidade->estado->cidades->pluck('nome','id');

        $load = $cliente->loadFormFields();

        return view('clientes.form', compact('cliente', 'cliente_telefone','load','cidades'));
    }

    public function update($id, Request $request)
    {
//        $this->customValidate($request->all(), new ClienteValidator(), 'update');
        $request = $this->limpaArray($request->all());

        $cliente = Cliente::findOrFail($id);

        AssociaTelefone::associa($request['cliente_telefone'], $cliente);

        $cliente->update($request);

        return redirect()->to('clientes');
    }

    public function delete($id)
    {
//        $this->authorize('destroy', Cliente::class);

        Cliente::findOrFail($id)->delete();

        return redirect()->to('clientes');
    }

    public function produtos($id,Request $request)
    {
        //        $this->authorize('show', Cliente::class);

        $cliente =  Cliente::findOrFail($id);

        $produtos = $cliente->produtos()->get();



        return view('clientes.produtos', compact('produtos','id'));
    }

    public function servicos($id,Request $request)
    {
//        $this->authorize('show', Cliente::class);

        $cliente =  Cliente::findOrFail($id);

        $servicos = $cliente->servicos()->get();

        return view('clientes.servicos', compact('servicos','id'));
    }

    public function vendas($id,Request $request)
    {
//        $this->authorize('show', Cliente::class);

        $cliente =  Cliente::findOrFail($id);

        $servicos = $cliente->vendas()->get();

        return view('clientes.servicos', compact('servicos','id'));
    }

}
