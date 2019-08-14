<?php namespace App\Projeto\Variaveis;


use App\Projeto\Entity;
use App\Projeto\Financeiro\ContasAPagar;

class TipoPagamento extends Entity
{
    protected $table = "tipos_pagamentos";

    protected $fillable = [
        'descricao'
    ];

    public function pagamentos()
    {
        return $this->hasMany(ContasAPagar::class, "tipo_pagamento_id");
    }
}
