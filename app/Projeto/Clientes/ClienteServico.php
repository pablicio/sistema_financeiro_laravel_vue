<?php namespace App\Projeto\Clientes;

use App\Projeto\Entity;
use App\Projeto\Servicos\Servico;

class ClienteServico extends Entity
{
    protected $table = "clientes_servicos";

    protected $fillable = [
        'cliente_id',
        'servico_id',
        'quatidade'
    ];

    function servico()
    {
        return $this->belongsTo(Servico::class, "servico_id");
    }

    public function cliente()
    {
        return $this->hasMany(Cliente::class, "cliente_id");
    }
}
