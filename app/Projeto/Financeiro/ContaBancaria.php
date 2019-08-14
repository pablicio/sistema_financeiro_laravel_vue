<?php namespace App\Projeto\Financeiro;

use App\Projeto\Entity;
use App\Projeto\Variaveis\Banco;

class ContaBancaria extends Entity
{
    protected $table = "contas_bancarias";

    protected $fillable = [
        'banco_id',
        'agencia',
        'conta',

        'favorecido'
    ];



    public static function loadFormFields()
    {
        return [
            'bancos' => Banco::pluck('nome', 'id'),
        ];
    }




    public function bancos()
    {
        return $this->belongsTo(Banco::class, 'banco_id');
    }

    public function conciliacoes()
    {
        return $this->hasMany(ConciliacaoBancaria::class, 'conta_bancaria_id');
    }
}
