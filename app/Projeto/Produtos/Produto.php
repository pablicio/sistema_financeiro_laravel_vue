<?php namespace App\Projeto\Produtos;

use App\Helpers\Consulta;
use App\Projeto\Entity;
use App\Projeto\Sistema\Estado;
use Yajra\Datatables\Facades\Datatables;

class Produto extends Entity
{
    protected $table = "produtos";

    protected $fillable = [
        'referencia',
        'nome',
        'valor'
    ];

    protected $convert = [
        'valor' => 'money',
    ];

    const COLUMNS_OF_DATATABLE_RELATORIO = [
        ['data' => 'nome', 'name' => 'nome', 'title' => 'Nome'],
        ['data' => 'referencia', 'name' => 'referencia', 'title' => 'Referência'],
        ['data' => 'valor', 'name' => 'valor', 'title' => 'Valor'],
//        ['data' => 'action', 'name' => 'action', 'title' => 'Ações']
    ];

    public function datatableRelatorio($produtos)
    {
        return Datatables::of($produtos)->make(true);
    }

    public function dadosDatatableRelatorio($produtos, $request)
    {
        $produtos = Consulta::montar($produtos, $request->all())
            ->get();

        return $produtos;
    }


    public static function loadFormFields()
    {
        return [
            'estados' => Estado::pluck('nome', 'id'),
        ];
    }
}
