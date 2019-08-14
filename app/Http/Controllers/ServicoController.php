<?php namespace App\Http\Controllers;


use App\Projeto\Servicos\Servico;
use App\Validators\ServicoValidator;
use Illuminate\Http\Request;

class ServicoController extends Controller
{


    public function index(Request $request)
    {
//        $this->authorize('show', Servico::class);

        $servicos = Servico::get();

        return view('servicos.index', compact('servicos'));
    }

    public function create()
    {
//        $this->authorize('create', Servico::class);

        $load = Servico::loadFormFields();

        $cidades = [];

        return view('servicos.form', compact('load','cidades'));
    }

    public function store(Request $request)
    {
        $this->customValidate($request->all(), new ServicoValidator());

        $servico = new Servico();

        $servico = $servico->create($request->all());

        return redirect()->to('/servicos');
    }

    public function edit($id)
    {
//        $this->authorize('update', Servico::class);

        $servico = Servico::findOrFail($id);

        $load = $servico->loadFormFields();

        return view('servicos.form', compact('servico','load'));
    }

    public function update($id, Request $request)
    {
//        $this->customValidate($request->all(), new ServicoValidator(), 'update');

        $servico = Servico::findOrFail($id);

        $servico->update($request->all());

        return redirect()->to('servicos');
    }

    public function delete($id)
    {
//        $this->authorize('destroy', Servico::class);

        Servico::findOrFail($id)->delete();

        return redirect()->to('servicos');
    }
}
