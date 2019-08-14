<?php namespace App\Http\Controllers;


use App\Helpers\EstruturaArray;
use App\Helpers\Pagamentos;
use App\Projeto\Clientes\Cliente;
use App\Projeto\Financeiro\Invoice;
use App\Projeto\Financeiro\Venda;
use App\Projeto\Produtos\Produto;
use App\Projeto\Servicos\Servico;
use App\Projeto\Variaveis\Cartao;
use App\Projeto\Variaveis\FormaPagamento;
use Illuminate\Http\Request;

class VendaController extends Controller
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

    public function clienteVendas($id, Request $request)
    {
//        $this->authorize('show', Cliente::class);

        $cliente = Cliente::findOrFail($id);

        $vendas = $cliente->vendas()->get();

        return view('vendas.index', compact('vendas', 'cliente'));
    }

    public function show($id)
    {
//        $this->authorize('create', Venda::class);

        $venda = Venda::findOrFail($id);


        $load = $venda->loadFormFields();


        return view('vendas.show', compact('venda', 'load'));
    }

    public function printVenda($id)
    {
//        $this->authorize('show', Boleto::class);

        $venda = Venda::find($id);

        return $venda
            ->generateDocVenda($venda)
            ->stream();
    }

    public function create($id)
    {
//        $this->authorize('create', Venda::class);

        $load = Venda::loadFormFields();

        $cliente = Cliente::find($id);
//        $array = EstruturaArray::estruturarPlanoDeContas($load['contas_contabeis']);

        return view('vendas.form', compact('array','id', 'load', 'cliente'));
    }

    public function store(Request $request)
    {
        $request = $this->limpaArray($request->input());

        unset($request['_token']);

//        $this->customValidate($request->all(), new VendaValidator());

        $venda = new Venda();

        $venda = $venda->create($request['venda']);

        Invoice::createInvoice($request, $venda);

//        foreach ($request as $key => $campos)
//            if (count(array_filter($campos)) > 1)
//                $this->customValidate($campos, new InvoiceValidator(), $key);

        Pagamentos::contasAReceberCreate($request, $venda->id);

        return redirect()->to('vendas/' . $venda->id . '/show');
    }

    public function edit($id)
    {
//        $this->authorize('update', Venda::class);

        $venda = Venda::findOrFail($id);

        $load = $venda->loadFormFields();

        $array = EstruturaArray::estruturarPlanoDeContas($load['contas_contabeis']);

        return view('vendas.form', compact('venda', 'load','array'));
    }

    public function update($id, Request $request)
    {
        $request = $this->limpaArray($request->input());
//        $this->customValidate($request->all(), new VendaValidator(), 'update');

        $venda = Venda::findOrFail($id);

        Invoice::updateOrCreate($request,$venda);

        Pagamentos::contasAReceberUpdate($request, $venda->id);

        $venda->update($request['venda']);

        return redirect()->to('vendas/' . $venda->id . '/show');
    }

    public function delete($id)
    {
//        $this->authorize('destroy', Venda::class);

        Venda::findOrFail($id)->delete();

        return redirect()->to('vendas');
    }
}
