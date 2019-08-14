<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\ValidationException;
use Yajra\Datatables\Html\Builder;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $htmlBuilder;

    public function __construct(Builder $htmlBuilder)
    {
        $this->htmlBuilder = $htmlBuilder;
    }

    public function limpaArray($array)
    {
        foreach ($array as $key => &$value) {
            if (empty($value)) {
                unset($array[$key]);
            } else {
                if (is_array($value)) {
                    $value = self::limpaArray($value);
                    if (empty($value)) {
                        unset($array[$key]);
                    }
                }
            }
        }
        return $array;
    }

    public function getColunms($colunmus)
    {
        return $this->htmlBuilder->columns($colunmus)
            ->parameters([
                'language' => [
                    'search' => '<span>Busca:</span> _INPUT_',
                    'paginate' =>  ['first' => 'Primeiro', 'last' => 'Último', 'next' => '&rarr;', 'previous' => '&larr;'],
                    'sInfo' => "&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMostrando de _START_ até _END_ de _TOTAL_ registros",
                    'sZeroRecords' => "Nenhum registro encontrado",
                    'sInfoEmpty' => "&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMostrando 0 até 0 de 0 registros",
                    'sEmptyTable' => "Nenhum registro encontrado",
                    "processing" => "Carregando...",
                    'buttons' => [
                        'copy' => 'Copiar',
                        'copyTitle' => 'Copiando Registros',
                        'copySuccess' => [
                            '1' => "Copiando..",
                            '_' => "Copiando %d registros da página"
                        ],
                    ],
                ],
                'searching' => true,
                "bLengthChange" =>    false,
                'dom' => '<"pull-right"B>lfrtip',
                'buttons' => [
                    [
                        'extend' => 'copyHtml5',
                        'text' => '<i class="icon-copy3 position-left"></i> Copiar',
                        'className' => 'btn btn-default',
                        'exportOptions' => [
                            'columns' => [0, ':visible']
                        ]

                    ],
                    [
                        'extend' => 'excelHtml5',
                        'text' => '<i class="icon-file-excel position-left"></i> Excel',
                        'className' => 'btn btn-default',
                        'exportOptions' => [
                            'columns' => [0, ':visible']
                        ]

                    ],
                    [
                        'extend' => 'pdfHtml5',
                        'text' => '<i class="icon-file-pdf position-left"></i> PDF',
                        'className' => 'btn btn-default',
                        'exportOptions' => [
                            'columns' => [0, ':visible']
                        ]

                    ],
                    [
                        'extend' => 'colvis',
                        'text' => '<i class="icon-three-bars"></i> <span class="caret"></span>',
                        'className' => 'btn btn-default'
                    ]
                ]
            ]);
    }


    public function customValidate($request, $validator, $type = 'create')
    {
        $validator = $validator->makeValidation($request, $type);

        if ($validator->fails()) {

            throw new ValidationException($validator);
        }
    }
}
