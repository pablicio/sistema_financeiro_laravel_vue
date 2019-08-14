<?php namespace App\Projeto\Sistema;

use App\Projeto\Entity;
use App\Projeto\Funcionarios\Funcionario;

class Cidade extends Entity
{
    protected $table = "cidades";

    protected $fillable = [
        'nome',
        'estado_id'
    ];


    public function funcionario()
    {
        return $this->hasMany(Funcionario::class, "cidade_id");
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
