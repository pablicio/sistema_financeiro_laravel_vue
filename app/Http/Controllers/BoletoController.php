<?php namespace App\Http\Controllers;

use App\Entities\Clientes\Cliente;
use App\Entities\Financeiro\Boleto;
use App\Entities\Financeiro\ContasAReceber;
use App\Remessa;
use Illuminate\Http\Request;


class BoletoController extends Controller
{
    public function boletos($id)
    {
        $this->authorize('create', Boleto::class);

        $boleto = new Boleto();

        $boletoGerado = $boleto->newBoleto($id);

        return view('boletos.boleto', compact('boletoGerado'));
    }

    public function envioBoleto($id)
    {
        $this->authorize('show', Boleto::class);

        $boleto = new Boleto();

        $boletoGerado = $boleto->newBoleto($id);

        $response = response($boletoGerado->renderPDF(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; boleto.pdf',
        ]);

        $cliente = Cliente::find(ContasAReceber::find($id)->cliente->id);

        $cliente->sendBoleto($response);

        return $response;
    }

    public function remessas(Request $request)
    {
        $this->authorize('create', Boleto::class);

        $remessas = new Remessa();

        if($request->ajax()) {
            return $remessas->datatable($remessas->get());
        }

        $html = $this->getColunms(Remessa::COLUMNS_OF_DATATABLE);

        return view('boletos.boletoRemessa', compact('html'));
    }
}
