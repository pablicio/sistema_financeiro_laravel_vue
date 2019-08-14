<?php namespace App\Projeto\Funcionarios;

use App\Projeto\Entity;

class TipoPerfil extends Entity
{
    protected $table = "tipos_perfis";

    protected $fillable = [
        'setor'
    ];

    public function funcionario()
    {
        return $this->hasMany(Funcionario::class, "tipo_perfil_id");
    }
}
