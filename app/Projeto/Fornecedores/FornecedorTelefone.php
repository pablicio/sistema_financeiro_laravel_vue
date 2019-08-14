<?php namespace App\Projeto\Fornecedores;


use App\Projeto\Entity;

class FornecedorTelefone extends Entity
{
    protected $table = "fornecedores_telefones";

    protected $fillable = [
        'fornecedor_id',
        'telefone'
    ];

    protected $convert = [
        'telefone' => 'fone',
    ];

    public function fornecedores()
    {
        return $this->hasMany(Fornecedor::class, "fornecedor_id");
    }
}
