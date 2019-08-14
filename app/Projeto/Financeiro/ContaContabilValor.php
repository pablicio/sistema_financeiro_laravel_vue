<?php namespace App\Projeto\Financeiro;

use App\Projeto\Entity;

class ContaContabilValor extends Entity
{
    protected $table = "conta_contabil_valores";

    protected $fillable = [
        'conta_pagar_id',
        'conta_receber_id',
        'conta_id',
        'valor',
        'data_pagamento'
    ];

    protected $convert = [
        'data_pagamento' => 'date',
        'valor' => 'money'
    ];

    public function contaContabil()
    {
        return $this->belongsTo(ContaContabil::class, 'conta_id');
    }
}
