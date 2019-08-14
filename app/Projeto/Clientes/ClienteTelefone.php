<?php namespace App\Projeto\Clientes;

use App\Projeto\Entity;

class ClienteTelefone extends Entity
{
    protected $table = "clientes_telefones";

    protected $fillable = [
        'cliente_id',
        'telefone'
    ];

    protected $convert = [
        'telefone' => 'fone',
    ];

    public function cliente()
    {
        return $this->hasMany(Cliente::class, "cliente_id");
    }
}
