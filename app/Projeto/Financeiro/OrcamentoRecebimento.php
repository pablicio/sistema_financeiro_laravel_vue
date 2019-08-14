<?php namespace App\Projeto\Financeiro;

use App\Projeto\Clientes\Cliente;
use App\Projeto\Entity;
use App\Projeto\Variaveis\Banco;
use App\Projeto\Variaveis\Cartao;

class OrcamentoRecebimento extends Entity
{
    protected $table = "orcamentos_recebimentos";

    protected $fillable = [
        'cliente_id',
        'conta_id',
        'orcamento_id',
        'banco_id',
        'cartao_id',
        'forma_de_pagamento_id',
        'valor',
        'valor_parcelado',
        'data_vencimento',
        'data_pagamento',
        'total_parcelas',
        'nosso_numero',
        'carteira',
        'parcela',
        'numero_cheque',
        'created_at',
        'desconto',
    ];

    const CREDITO = 6;

    const ZERO = 0;

    protected $convert = [
        'data_pagamento' => 'date',
        'data_vencimento' => 'date',
        'valor' => 'money',
        'valor_parcelado' => 'money',
        'desconto' => 'money',
    ];



    public function cliente()
    {
        return $this->belongsTo(Cliente::class, "cliente_id");
    }

    public function invoices()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function formasPagamento()
    {
        return $this->belongsTo(FormasDePagamento::class, "forma_de_pagamento_id");
    }

    public function bancos()
    {
        return $this->belongsTo(Banco::class, 'banco_id');
    }

    public function cartoes()
    {
        return $this->belongsTo(Cartao::class, 'cartao_id');
    }
}
