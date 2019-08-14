<?php namespace App\Http\Controllers;

use App\Projeto\Variaveis\TipoDespesa;
use Illuminate\Http\Request;

class TiposDespesaController extends Controller
{
    public function getTiposDespesas()
    {
        return TipoDespesa::get();
    }
}
