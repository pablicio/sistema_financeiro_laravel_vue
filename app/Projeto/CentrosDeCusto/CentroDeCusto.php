<?php namespace App\Projeto\CentrosDeCusto;

use App\Projeto\Entity;

class CentroDeCusto extends Entity
{
    protected $table = "centros_de_custo";

    protected $fillable = [
        'descricao',
    ];
}
