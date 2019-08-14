<?php namespace App\Projeto\Servicos;

use App\Helpers\Consulta;
use App\Projeto\Entity;
use App\Projeto\Sistema\Estado;
use Yajra\Datatables\Facades\Datatables;

class Servico extends Entity
{
    protected $table = "servicos";

    protected $fillable = [
        'referencia',
        'nome',
        'valor'
    ];

    protected $convert = [
        'valor' => 'money'
    ];

    const COLUMNS_OF_DATATABLE_RELATORIO = [
        ['data' => 'nome', 'name' => 'nome', 'title' => 'Nome'],
        ['data' => 'referencia', 'name' => 'referencia', 'title' => 'Referência'],
        ['data' => 'valor', 'name' => 'valor', 'title' => 'Valor'],
//        ['data' => 'action', 'name' => 'action', 'title' => 'Ações']
    ];

    public function datatableRelatorio($servicos)
    {
        return Datatables::of($servicos)->make(true);
    }

    public function dadosDatatableRelatorio($servicos, $request)
    {
        $servicos = Consulta::montar($servicos, $request->all())
            ->get();

        return $servicos;
    }



    public static function loadFormFields()
    {
        return [
            'estados' => Estado::pluck('nome', 'id'),
        ];
    }
}
