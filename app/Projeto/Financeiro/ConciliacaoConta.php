<?php namespace App\Projeto\Financeiro;

use App\Projeto\Entity;

class ConciliacaoConta extends Entity
{
    protected $table = "conciliacoes_contas";

    protected $fillable = [
        'conciliacao_id',
        'conta_pagar_id',
        'conta_receber_id'
    ];

    public function conciliacoes()
    {
        return $this->hasMany(ConciliacaoBancaria::class, "conciliacao_id");
    }

    public function contasAPagar()
    {
        return $this->belongsTo(ContasAPagar::class, "conta_pagar_id");
    }

    public function contasAReceber()
    {
        return $this->hasMany(ContasAReceber::class, "conta_receber_id");
    }
}
