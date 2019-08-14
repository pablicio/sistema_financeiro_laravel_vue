<?php

namespace App\Http\Controllers;

use App\Helpers\Teste;
use App\Projeto\CentrosDeCusto\CentroDeCusto;
use App\Projeto\Clientes\Cliente;
use App\Projeto\Financeiro\ContaContabil;
use App\Projeto\Produtos\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\Cloner\Data;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function readItems(Request $req)
    {

        $data = CentroDeCusto::all();

        return view('shared.index')->withData($data);
    }

    public function addItem(Request $request)
    {
        $data = CentroDeCusto::create($request->all());

        return response()->json($data);
    }

    public function editItem(Request $req)
    {
        $data = CentroDeCusto::find($req->id);

        $data->update($req->all());

        return response()->json($data);
    }


    public function deleteItem(Request $req)
    {
        CentroDeCusto::find($req->id)->delete();

        return response()->json();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $data = CentroDeCusto::all();

        $produtos = Produto::get();

        return view('shared.teste', compact('produtos'));
    }
}
