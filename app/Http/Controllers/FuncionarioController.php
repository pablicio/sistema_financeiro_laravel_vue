<?php namespace App\Http\Controllers;

//use App\Entities\Estado;
//use App\Entities\Funcionarios\Funcionario;
//use App\Entities\Funcionarios\FuncionarioTelefone;
//use App\Entities\Funcionarios\TipoPerfil;
//use App\Helpers\AssociaTelefone;
use App\Helpers\AssociaTelefone;
use App\Projeto\Funcionarios\Funcionario;
use App\Validators\FuncionarioValidator;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class FuncionarioController extends Controller
{

    public function index(Request $request)
    {
//        $this->authorize('show', Funcionario::class);

        $funcionario = new Funcionario();

        if ($request->ajax()) {

            return $funcionario->datatable($funcionario->dadosDatatable());
        }

        $html = $this->getColunms(Funcionario::COLUMNS_OF_DATATABLE);

        return view('funcionarios.index', compact('html'));
    }


//    public function index(Request $request)
//    {
////        $this->authorize('show', Funcionario::class);
//
//        $funcionarios = Funcionario::get();
//
//        return view('funcionarios.index', compact('funcionarios'));
//    }

    public function create()
    {
//        $this->authorize('create', Funcionario::class);

        $load = Funcionario::loadFormFields();

        $cidades = [];

        return view('funcionarios.form', compact('load','cidades'));
    }

    public function store(Request $request)
    {
        $request = $this->limpaArray($request->all());

        $this->customValidate($request, new FuncionarioValidator());

        $funcionario = new Funcionario();

        $funcionario = $funcionario->create($request);

        $funcionario->telefones()->createMany($request['funcionario_telefone']);

        return redirect()->to('/funcionarios');
    }

    public function edit($id)
    {
//        $this->authorize('update', Funcionario::class);

        $funcionario = Funcionario::findOrFail($id);

        $funcionario_telefone = $funcionario->telefones()->get()->toArray();

        $cidades = $funcionario->cidade->estado->cidades->pluck('nome','id');

        $load = $funcionario->loadFormFields();

        return view('funcionarios.form', compact('funcionario', 'funcionario_telefone','load','cidades'));
    }

    public function update($id, Request $request)
    {
//        $this->customValidate($request->all(), new FuncionarioValidator(), 'update');
        $request = $this->limpaArray($request->all());

        $funcionario = Funcionario::findOrFail($id);

        AssociaTelefone::associa($request['funcionario_telefone'], $funcionario);

        $funcionario->update($request);

        return redirect()->to('funcionarios');
    }

    public function delete($id)
    {
//        $this->authorize('destroy', Funcionario::class);

        Funcionario::findOrFail($id)->delete();

        return redirect()->to('funcionarios');
    }
}
