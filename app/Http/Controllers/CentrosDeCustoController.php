<?php namespace App\Http\Controllers;

use App\Projeto\CentrosDeCusto\CentroDeCusto;
use App\Validators\CentrosDeCustoValidator;
use Illuminate\Http\Request;

class CentrosDeCustoController extends Controller
{

    public function getCentrosDeCusto()
    {
        return CentroDeCusto::get();
    }

    public function index(Request $request)
    {
//        $this->authorize('show', Centros_de_custo::class);

        $centros_de_custo = CentroDeCusto::get();

        return view('centros_de_custo.index', compact('centros_de_custo'));
    }

    public function create()
    {
//        $this->authorize('create', Centros_de_custo::class);

        return view('centros_de_custo.form');
    }

    public function store(Request $request)
    {
        $this->customValidate($request->all(), new CentrosDeCustoValidator);

        $centros_de_custo = new CentroDeCusto();

        $centros_de_custo->create($request->all());

        return redirect()->to('/centros_de_custo');
    }

    public function edit($id)
    {
//        $this->authorize('update', Centros_de_custo::class);

        $centros_de_custo = CentroDeCusto::findOrFail($id);

        return view('centros_de_custo.form', compact('centros_de_custo'));
    }

    public function update($id, Request $request)
    {
//        $this->customValidate($request->all(), new Centros_de_custoValidator(), 'update');

        $centros_de_custo = CentroDeCusto::findOrFail($id);

        $centros_de_custo->update($request->all());

        return redirect()->to('centros_de_custo');
    }

    public function delete($id)
    {
//        $this->authorize('destroy', Centros_de_custo::class);

        CentroDeCusto::findOrFail($id)->delete();

        return redirect()->to('centros_de_custo');
    }
}
