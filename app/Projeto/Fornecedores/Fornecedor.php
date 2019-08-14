<?php namespace App\Projeto\Fornecedores;


use App\Projeto\Entity;
use App\Projeto\Sistema\Cidade;
use App\Projeto\Sistema\Estado;

class Fornecedor extends Entity
{
    protected $table = "fornecedores";

    protected $fillable = [
        'unidade_id',
        'cidade_id',
        'tipo_fornecedor_id',
        'nome',
        'cpf',
        'cnpj',
        'razao_social',
        'rg',
        'email',
        'cep',
        'endereco',
        'bairro',
        'observacao',
        'data_nascimento'
    ];

    protected $convert = [
        'cpf' => 'cpf',
        'fone' => 'fone',
        'cep' => 'cep',
        'data_nascimento' => 'date'

    ];

    public static function loadFormFields()
    {
        return [
            'estados' => Estado::pluck('nome', 'id'),

            'cidades' => Cidade::pluck('nome', 'id'),

            'tipos_fornecedores' => FornecedorTipo::pluck('descricao', 'id'),
        ];
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, "cidade_id");
    }

    public function telefones()
    {
        return $this->hasMany(FornecedorTelefone::class, "fornecedor_id");
    }

    public function tipoFornecedor()
    {
        return $this->belongsTo(FornecedorTipo::class, "tipo_fornecedor_id");
    }
}
