<?php namespace App\Projeto\Funcionarios;

use App\Projeto\Entity;

class FuncionarioTelefone extends Entity
{
    protected $table = "funcionarios_telefones";

    protected $fillable = [
        'funcionario_id',
        'telefone'
    ];

    protected $convert = [
        'telefone' => 'fone',
    ];

    public function funcionario()
    {
        return $this->hasMany(Funcionario::class, "funcionario_id");
    }
}