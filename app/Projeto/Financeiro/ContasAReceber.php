<?php namespace App\Projeto\Financeiro;

use App\Helpers\Consulta;
use App\Projeto\Clientes\Cliente;
use App\Projeto\Entity;
use App\Projeto\Variaveis\Banco;
use App\Projeto\Variaveis\Cartao;
use App\Projeto\Variaveis\FormaPagamento;
use App\Support\Convert;
use Yajra\Datatables\Facades\Datatables;

class ContasAReceber extends Entity
{
    protected $table = "contas_a_receber";

    protected $fillable = [
        'cliente_id',
        'conta_id',
        'venda_id',
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
        'descricao'
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

    const COLUMNS_OF_DATATABLE_RELATORIO = [
        ['data' => 'cliente', 'name' => 'cliente', 'title' => 'Cliente'],
        ['data' => 'formasPagamento', 'name' => 'formasPagamento', 'title' => 'Forma de Pagamento'],
        ['data' => 'data_vencimento', 'name' => 'data_vencimento', 'title' => 'Data de Vencimento'],
        ['data' => 'data_pagamento', 'name' => 'data_pagamento', 'title' => 'Data de Pagamento'],
        ['data' => 'valor', 'name' => 'valor', 'title' => 'Valor'],

//        ['data' => 'action', 'name' => 'action', 'title' => 'Ações']
    ];

    public function datatableRelatorio($contas_a_receber)
    {
        return Datatables::of($contas_a_receber)->make(true);
    }

    public function dadosDatatableRelatorio($contas_a_receber, $request)
    {
        $contas_a_receber = Consulta::montar($contas_a_receber, $request->all())->select([
            'contas_a_receber.*',
            'clientes.nome as cliente',
            'formas_pagamentos.descricao as formasPagamento',
        ])->leftJoin('clientes', 'clientes.id', '=', 'contas_a_receber.cliente_id')
            ->leftJoin('formas_pagamentos', 'formas_pagamentos.id', '=', 'contas_a_receber.forma_de_pagamento_id')
            ->get();

        return $contas_a_receber;
    }

    public function dadosDatatable($invoice_id)
    {
        $contas_a_receber = ContasAReceber::select([
            'contas_a_receber.*',
            'clientes.nome as cliente',
            'unidades.razao_social as unidade',
            'formas_de_pagamento.descricao as formasPagamento',
            'bancos.nome as banco',
        ])
            ->where('invoice_id', $invoice_id)
            ->leftJoin('clientes', 'clientes.id', '=', 'contas_a_receber.cliente_id')
            ->leftJoin('unidades', 'unidades.id', '=', 'contas_a_receber.unidade_id')
            ->leftJoin('formas_de_pagamento', 'formas_de_pagamento.id', '=', 'contas_a_receber.forma_de_pagamento_id')
            ->leftJoin('bancos', 'bancos.id', '=', 'contas_a_receber.banco_id')
            ->get();

        return $contas_a_receber;
    }


    public function datatable($contas_a_receber)
    {
        return Datatables::of($contas_a_receber)
            ->setTransformer(new ContasAReceberTransformer)
            ->make(true);

    }

    public static function loadFormFields()
    {
        return [
            'clientes' => Cliente::pluck('nome', 'id'),
            'formasDePagamento' => FormaPagamento::pluck('descricao', 'id'),
            'contas_contabeis' => ContaContabil::all()->toArray(),
        ];
    }


    public function cliente()
    {
        return $this->belongsTo(Cliente::class, "cliente_id");
    }

    public function invoices()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function contaContabilValor()
    {
        return $this->belongsTo(ContaContabilValor::class, "conta_receber_id");
    }

    public function formasPagamento()
    {
        return $this->belongsTo(FormaPagamento::class, "forma_de_pagamento_id");
    }

    public function bancos()
    {
        return $this->belongsTo(Banco::class, 'banco_id');
    }

    public function cartoes()
    {
        return $this->belongsTo(Cartao::class, 'cartao_id');
    }

    public function createAfterPgto($conta, $request)
    {
        $conta->contaContabilValor()
            ->updateOrCreate(
                [
                    'conta_pagar_id' => $conta->id
                ],
                [
                    'valor' => Convert::moneyToDecimal($request['valor']),
                    'conta_id' => $request['conta_id'],
                    'data_pagamento' => $request['data_pagamento']
                ]);
    }
}
