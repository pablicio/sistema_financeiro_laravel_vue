<?php namespace App\Projeto\Financeiro;

use App\Projeto\Entity;
use App\Projeto\Variaveis\Banco;

class ConciliacaoOfx extends Entity
{
    protected $table = 'conciliacoes_ofx';

    protected $fillable = [
        'banco_id',
        'ofx_name',
        'balance'
    ];

    public function movimentacoes()
    {
        return $this->hasMany(ConciliacaoBancaria::class,"ofx_id");
    }

    public function banco()
    {
        return $this->belongsTo(Banco::class,"banco_id");
    }
}
