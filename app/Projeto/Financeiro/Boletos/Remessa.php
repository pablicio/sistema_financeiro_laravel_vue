<?php namespace App;

use App\Entities\Entity;
use Yajra\Datatables\Facades\Datatables;

class Remessa extends Entity
{
    protected $table = 'remessas';

    protected $fillable = [
        'nome_arquivo_remessa',
        'link_arquivo_remessa',
        'nome_arquivo_pdf',
        'link_arquivo_pdf',
        'total_boletos'
    ];

    const COLUMNS_OF_DATATABLE = [
        ['data' => 'documento', 'name' => 'documento', 'title' => 'Baixar Arquivo REM'],
        ['data' => 'pdf', 'name' => 'pdf', 'title' => 'Pdfs da Remessa'],
        ['data' => 'total_boletos', 'name' => 'total_boletos', 'title' => 'Total de Boletos']
    ];

    public function datatable($remessas)
    {
        return Datatables::of($remessas)
            ->addColumn('documento', function ($documento) {
                return '<td class="text-center"> <a href="' . $documento->link_arquivo_remessa . '">' . $documento->nome_arquivo_remessa . '</a></td>';
            })
            ->addColumn('pdf', function ($documento) {
                return '<td class="text-center"> <a href="' . $documento->link_arquivo_pdf . '">' . $documento->nome_arquivo_pdf . '</a></td>';
            })
            ->addColumn('total_boletos', function ($documento) {
                return '<td class="text-center">'. $documento->total_boletos .'</td>';
            })->make(true);
    }

}
