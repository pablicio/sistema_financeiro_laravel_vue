<?php
/**
 * Created by PhpStorm.
 * User: Chronos Tecnologia
 * Date: 07/07/2017
 * Time: 12:27
 */

namespace App\Helpers;


class ArrayMeses
{
    public static $meses = [
        [
            'mes' => 1,
            'valor' => 0
        ],
        [
            'mes' => 2,
            'valor' => 0
        ],
        [
            'mes' => 3,
            'valor' => 0
        ],
        [
            'mes' => 4,
            'valor' => 0
        ],
        [
            'mes' => 5,
            'valor' => 0
        ],
        [
            'mes' => 6,
            'valor' => 0
        ],
        [
            'mes' => 7,
            'valor' => 0
        ],
        [
            'mes' => 8,
            'valor' => 0
        ],
        [
            'mes' => 9,
            'valor' => 0
        ],
        [
            'mes' => 10,
            'valor' => 0
        ],
        [
            'mes' => 11,
            'valor' => 0
        ],
        [
            'mes' => 12,
            'valor' => 0
        ]
    ];

    public static function formataArray($array)
    {
        $meses = ArrayMeses::$meses;

        foreach ($meses as $chave => $mes) {

            foreach ($array as $key => $value) {

                if ($value->mes == $mes['mes']) {

                    $meses[$chave] = ['mes' => $value->mes, 'valor' => $value->valor];
                    unset($array[$key]);

                }
            }
        }

        return $meses;
    }

    public static function formataArrayPorExtenso($array)
    {
        $meses = ArrayMeses::$mesesPorExtenso;

        foreach ($meses as $chave => $mes) {

            foreach ($array as $key => $value) {
                if ($value->mes == $mes['mes']) {
                    $meses[$chave] = ['mes' => $value->mes, 'valor' => $value->valor, 'nome' => $mes['nome']];
                    unset($array[$key]);

                }
            }
        }

        return $meses;
    }

    public static $mesesPorExtenso = [
        [
            'nome' => "Janeiro",
            'mes' => 1,
            'valor' => 0
        ],
        [
            'nome' => "Fevereiro",

            'mes' => 2,
            'valor' => 0
        ],
        [
            'nome' => "Março",
            'mes' => 3,

            'valor' => 0
        ],
        [
            'nome' => "Abril",
            'mes' => 4,

            'valor' => 0
        ],
        [
            'nome' => "Maio",
            'mes' => 5,

            'valor' => 0
        ],
        [
            'nome' => "Junho",
            'mes' => 6,

            'valor' => 0
        ],
        [
            'nome' => "Julho",
            'mes' => 7,

            'valor' => 0
        ],
        [
            'nome' => "Agosto",
            'mes' => 8,

            'valor' => 0
        ],
        [
            'nome' => "Setembro",
            'mes' => 9,

            'valor' => 0
        ],
        [
            'nome' => "Outubro",
            'mes' => 10,

            'valor' => 0
        ],
        [
            'nome' => "Novembro",
            'mes' => 11,

            'valor' => 0
        ],
        [
            'nome' => "Dezembro",
            'mes' => 12,

            'valor' => 0
        ]
    ];



}