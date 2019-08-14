<?php namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class Transformer extends TransformerAbstract
{
    public function format($date)
    {
        !empty($date) ? $format = Carbon::createFromFormat('Y-m-d H:i:s',trim($date))->format('d/m/Y') : $format = '';

        return $format;
    }


    public function format2($date)
    {
        !empty($date) ? $format = Carbon::createFromFormat('Y-m-d', trim($date))->format('d/m/Y') : $format = '';

        return $format;
    }


    public function formatSala($date)
    {
        !empty($date) ? $format = Carbon::createFromFormat('Y-m-d H:m:s', trim($date))->format('d/m/Y à\\s H:i\\h') : $format = '';

        return $format;
    }
}