<?php namespace App\Projeto\Financeiro;

use App\Projeto\Arquivos\GeraDocumento;
use App\Projeto\Clientes\Cliente;
use App\Projeto\Entity;
use App\Projeto\Funcionarios\Funcionario;
use App\Projeto\Produtos\Produto;
use App\Projeto\Servicos\Servico;

class Orcamento extends Entity
{
    protected $table = "orcamentos";

    protected $fillable = [
        'cliente_id',
        'produto_id',
        'servico_id',
        'funcionario_id',
        'descricao',
        'formas_pagamento',
        'previsao_entrega',
        'validade_orcamento',
        'data_venda',
        'valor_total',
    ];

    protected $convert = [
        'valor_total' => 'money',
        'data_venda' => 'date',

    ];

    public static function loadFormFields()
    {
        return [
            'produtos' => Produto::pluck('nome', 'id'),
            'servicos' => Servico::pluck('nome', 'id'),
            'funcionarios' => Funcionario::pluck('nome', 'id'),
        ];
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function funcionarios()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_id');
    }

    public function orcamentoItem()
    {
        return $this->hasMany(OrcamentoItem::class, 'orcamento_id');
    }

    public function orcamentoArquivo()
    {
        return $this->hasOne(OrcamentoArquivo::class, 'orcamento_id');
    }

    public function orcamentoRecebimento()
    {
        return $this->hasMany(OrcamentoRecebimento::class, 'orcamento_id');
    }

    public function generateDocOrcamento($orcamento)
    {
        return GeraDocumento::renderPrdf($orcamento,'orcamentos');
    }
}
