<?php namespace App\Projeto\Variaveis;

use App\Projeto\Entity;
use App\Projeto\Financeiro\ContasAPagar;

class TipoDespesa extends Entity
{
    protected $table = "tipos_despesas";

    protected $fillable = [
        'descricao',
        'unidade_id'
    ];

    public function pagamentos()
    {
        return $this->hasMany(ContasAPagar::class, "tipo_despesa_id");
    }
}
