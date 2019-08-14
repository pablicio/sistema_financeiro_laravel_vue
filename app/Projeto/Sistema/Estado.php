<?php namespace App\Projeto\Sistema;

use App\Projeto\Entity;

class Estado extends Entity
{
    protected $table = "estados";

    protected $fillable = [
        'nome',
        'uf'
    ];

    public function cidades()
    {
        return $this->hasMany(Cidade::class, "estado_id");
    }
}
