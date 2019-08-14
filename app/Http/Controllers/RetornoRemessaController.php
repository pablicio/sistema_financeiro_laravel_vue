<?php namespace App\Http\Controllers;

use App\Entities\Financeiro\Boleto;
use App\RetornoRemessa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RetornoRemessaController extends Controller
{
    public function import_retorno(Request $request)
    {
        $this->authorize('create', Boleto::class);

        $retorno = new RetornoRemessa();

        if ($request->ajax()) {
            return $retorno->datatable($retorno->get());
        }

        $html = $this->getColunms(RetornoRemessa::COLUMNS_OF_DATATABLE);

        return view('boletos/boletoRemessaRetorno',compact('html'));
    }

    public function store(Request $request)
    {
        $retorno = new RetornoRemessa();

        $retorno->retornoRemessa($request);

        return redirect()->back();
    }

    public function deleteDocument($id)
    {
        $this->authorize('destroy', Boleto::class);

        $documento = RetornoRemessa::find($id);

        Storage::deleteDirectory('admin/retorno/'. explode('\\',$documento->link)[1]);

        $documento->delete();

        return redirect()->back();
    }
}
