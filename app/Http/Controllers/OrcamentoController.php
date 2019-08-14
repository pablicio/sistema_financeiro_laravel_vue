<?php namespace App\Http\Controllers;


use App\Helpers\PagamentoOrcamento;
use App\Projeto\Clientes\Cliente;
use App\Projeto\Financeiro\Orcamento;
use App\Projeto\Financeiro\OrcamentoItem;
use App\Projeto\Produtos\Produto;
use App\Projeto\Servicos\Servico;
use App\Projeto\Variaveis\Cartao;
use App\Projeto\Variaveis\FormaPagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrcamentoController extends Controller
{
    public function getFormasPgto()
    {
        return [
            'formasPagamento' => FormaPagamento::get(),
            'cartoes' => Cartao::get(),
        ];

    }

    public function getData()
    {
        return [
            'servicos' => Servico::get(),
            'produtos' => Produto::get(),
        ];

    }

    public function clienteOrcamentos($id, Request $request)
    {
//        $this->authorize('show', Cliente::class);

        $cliente = Cliente::findOrFail($id);

        $orcamentos = $cliente->orcamentos()->get();

        return view('orcamentos.index', compact('orcamentos', 'cliente'));


//        return view('orcamentos.index', compact('orcamentos', 'cliente'));
    }

    public function show($id)
    {
//        $this->authorize('create', Orcamento::class);

        $orcamento = Orcamento::findOrFail($id);


        $load = $orcamento->loadFormFields();


        return view('orcamentos.show', compact('orcamento', 'load'));
    }

    public function create($id)
    {
//        $this->authorize('create', Orcamento::class);
        $cliente = Cliente::find($id);

        $load = Orcamento::loadFormFields();

        return view('orcamentos.form', compact('id', 'load', 'cliente'));
    }

    public function store(Request $request)
    {
        $request = $this->limpaArray($request->input());

        unset($request['_token']);

//        $this->customValidate($request->all(), new OrcamentoValidator());

        $orcamento = new Orcamento();

        $orcamento = $orcamento->create($request['orcamento']);

        OrcamentoItem::createOrcamentoItem($request, $orcamento);


//        foreach ($request as $key => $campos)
//            if (count(array_filter($campos)) > 1)
//                $this->customValidate($campos, new InvoiceValidator(), $key);

        return redirect()->to('/orcamentos/' . $orcamento->id . '/show');
    }

    public function edit($id)
    {
//        $this->authorize('update', Orcamento::class);

        $orcamento = Orcamento::findOrFail($id);


        $load = $orcamento->loadFormFields();


        return view('orcamentos.form', compact('orcamento', 'load'));
    }

    public function update($id, Request $request)
    {
        $request = $request->input();
//        $this->customValidate($request->all(), new OrcamentoValidator(), 'update');

        $orcamento = Orcamento::findOrFail($id);

        OrcamentoItem::updateOrCreateOrcamentoItem($request, $orcamento);

        $orcamento->update($request['orcamento']);

        return redirect()->to('orcamentos/' . $orcamento->id . '/show');
    }

    public function envioOrcamento($id)
    {
//        $this->authorize('show', Boleto::class);

        $orcamento = Orcamento::find($id);

        $docOrcamento = $orcamento
            ->generateDocOrcamento($orcamento);

        $cliente = Cliente::find($orcamento->cliente->id);

        $cliente->sendOrcamento($docOrcamento->stream(), $orcamento);
    }

    public function printOrcamento($id)
    {
//        $this->authorize('show', Boleto::class);

        $orcamento = Orcamento::find($id);

        return $orcamento
            ->generateDocOrcamento($orcamento)
            ->stream();
    }


    public function delete($id)
    {
//        $this->authorize('destroy', Orcamento::class);

        Orcamento::findOrFail($id)->delete();

        return redirect()->to('orcamentos');
    }
}
