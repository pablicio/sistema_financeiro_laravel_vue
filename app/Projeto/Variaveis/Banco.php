<?php namespace App\Projeto\Variaveis;

use App\Projeto\Financeiro\ContasAReceber;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $table = "bancos";

    protected $fillable = [
        'nome'
    ];

    public function contasAReceber()
    {
        return $this->hasMany(ContasAReceber::class, "banco_id");
    }

    public function conciliacoes()
    {
        return $this->hasMany(ConciliacaoBancaria::class, "banco_id");
    }

}
