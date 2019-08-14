<?php namespace App\Projeto\Variaveis;

use App\Projeto\Entity;
use App\Projeto\Financeiro\ContasAReceber;

class FormaPagamento extends Entity
{
    protected $table = "formas_pagamentos";

    protected $fillable = [
        'descricao'
    ];

    public function contasAReceber()
    {
        return $this->hasMany(ContasAReceber::class, "forma_de_pagamento_id");
    }
}
