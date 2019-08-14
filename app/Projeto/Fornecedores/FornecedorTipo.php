<?php namespace App\Projeto\Fornecedores;

use App\Projeto\Entity;

class FornecedorTipo extends Entity
{
    protected $table = "fornecedores_tipos";

    protected $fillable = [
        'descricao'
    ];

    public function fornecedor()
    {
        return $this->hasMany(Fornecedor::class, "tipo_fornecedor_id");
    }
}
