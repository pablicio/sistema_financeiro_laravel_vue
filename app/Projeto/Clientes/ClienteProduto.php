<?php namespace App\Projeto\Clientes;

use App\Projeto\Entity;
use App\Projeto\Produtos\Produto;

class ClienteProduto extends Entity
{
    protected $table = "clientes_produtos";

    protected $fillable = [
        'cliente_id',
        'produto_id',
        'quatidade'
    ];

    function produto()
    {
        return $this->belongsTo(Produto::class, "produto_id");
    }

    function cliente()
    {
        return $this->hasMany(Cliente::class, "cliente_id");
    }
}
