<?php namespace App\Projeto\Variaveis;

use App\Projeto\Entity;
use App\Projeto\Financeiro\ContasAPagar;

class SubTipoPagamento extends Entity
{
    protected $table = "sub_tipos_pagamentos";

    protected $fillable = [
        'descricao'
    ];

    public function pagamentos()
    {
        return $this->hasMany(ContasAPagar::class, "sub_tipo_pagamento_id");
    }

    public function tipoPagamentos()
    {
        return $this->belongsTo(TipoPagamento::class, "tipo_pagamento_id");
    }
}
