<?php namespace App\Projeto\Variaveis;

use App\Projeto\Entity;

class Situacao extends Entity
{
    protected $table = "situacoes";

    protected $fillable = [
        'descricao'
    ];

}
