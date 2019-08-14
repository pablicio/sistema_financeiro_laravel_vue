<?php namespace App\Projeto\Financeiro;

use App\Projeto\Arquivos\GeraDocumento;
use App\Projeto\Clientes\Cliente;
use App\Projeto\Entity;
use App\Projeto\Funcionarios\Funcionario;
use App\Projeto\Produtos\Produto;
use App\Projeto\Servicos\Servico;
use App\Projeto\Variaveis\Banco;
use App\Projeto\Variaveis\Cartao;
use App\Projeto\Variaveis\FormaPagamento;

class Venda extends Entity
{
    protected $table = "vendas";

    protected $fillable = [
        'cliente_id',
        'funcionario_id',
        'descricao',
        'previsao_entrega',
        'validade_venda',
        'data_venda',
        'valor_total',
        'conta_id'

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
            'bancos' => Banco::pluck('nome', 'id'),
            'cartoes' => Cartao::pluck('nome', 'id'),
            'formas_pagamento' => FormaPagamento::pluck('descricao', 'id'),
            'contas_contabeis' => ContaContabil::all()->toArray(),
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

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'venda_id');
    }

    public function contasAReceber()
    {
        return $this->hasMany(ContasAReceber::class, 'venda_id');
    }

    public function generateDocVenda($venda)
    {
        return GeraDocumento::renderPrdf($venda,'vendas');
    }

}
