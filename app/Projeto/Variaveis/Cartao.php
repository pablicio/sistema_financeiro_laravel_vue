<?php namespace App\Projeto\Variaveis;

use App\Projeto\Financeiro\ContasAReceber;
use Illuminate\Database\Eloquent\Model;

class Cartao extends Model
{
    protected $table = "cartoes";

    protected $fillable = [
        'nome'
    ];

    public function contasAReceber()
    {
        return $this->hasMany(ContasAReceber::class, "cartao_id");
    }
}
