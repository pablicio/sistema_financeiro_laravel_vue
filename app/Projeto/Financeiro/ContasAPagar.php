<?php namespace App\Projeto\Financeiro;

use App\Helpers\Consulta;
use App\Projeto\CentrosDeCusto\CentroDeCusto;
use App\Projeto\Entity;
use App\Projeto\Fornecedores\Fornecedor;
use App\Projeto\Variaveis\SubTipoPagamento;
use App\Projeto\Variaveis\TipoDespesa;
use App\Projeto\Variaveis\TipoPagamento;
use App\Support\Convert;
use Yajra\Datatables\Facades\Datatables;

class ContasAPagar extends Entity
{
    protected $table = "contas_a_pagar";

    protected $fillable = [
        'tipo_despesa_id',
        'centro_de_custo_id',
        'sub_tipo_pagamento_id',
        'fornecedor_id',
        'conciliacao_bancaria_id',
        'data_vencimento',
        'data_pagamento',
        'valor',
        'desconto',
        'deducao',
        'juros',
        'acrescimos',
        'descricao',
        'unidade_id',
        'created_at',
        'situacao_id',
        'conta_id'
    ];

    protected $convert = [
        'data_vencimento' => 'date',
        'data_pagamento' => 'date',
        'valor' => 'money',
        'desconto' => 'money',
        'deducao' => 'money',
        'juros' => 'money',
        'acrescimos' => 'money'

    ];

    const COLUMNS_OF_DATATABLE_RELATORIO = [
        ['data' => 'fornecedor', 'name' => 'fornecedor', 'title' => 'Fornecedor'],
        ['data' => 'subtiposPagamento', 'name' => 'subtiposPagamento', 'title' => 'SubTipo de Pagamento'],
        ['data' => 'TipoPagamento', 'name' => 'TipoPagamento', 'title' => 'Tipo de Pagamento'],
        ['data' => 'centrosDeCustos', 'name' => 'centrosDeCustos', 'title' => 'Centro de Custos'],
        ['data' => 'data_vencimento', 'name' => 'data_vencimento', 'title' => 'Vencimento'],
        ['data' => 'data_pagamento', 'name' => 'data_pagamento', 'title' => 'Pagamento'],
        ['data' => 'valor', 'name' => 'valor', 'title' => 'Valor'],
//        ['data' => 'action', 'name' => 'action', 'title' => 'Ações']
    ];

    public function dadosDatatable()
    {
        $contas_a_pagar = ContasAPagar::select([
            'contas_a_pagar.*',
            'sub_tipos_pagamentos.descricao as subtiposPagamento',
            'tipos_pagamentos.descricao as TipoPagamento',
            'centros_de_custo.descricao as centrosDeCustos',
            'fornecedores.nome as fornecedor',
        ])->leftJoin('centros_de_custo', 'centros_de_custo.id', '=', 'contas_a_pagar.centro_de_custo_id')
            ->leftJoin('sub_tipos_pagamentos', 'sub_tipos_pagamentos.id', '=', 'contas_a_pagar.sub_tipo_pagamento_id')
            ->leftJoin('fornecedores', 'fornecedores.id', '=', 'contas_a_pagar.fornecedor_id')
            ->leftJoin('tipos_pagamentos', 'tipos_pagamentos.id', '=', 'sub_tipos_pagamentos.tipo_pagamento_id')
            ->get();

        return $contas_a_pagar;
    }

    public function datatableRelatorio($contas_a_pagar)
    {
        return Datatables::of($contas_a_pagar)->make(true);
    }

    public function dadosDatatableRelatorio($contas_a_pagar, $request)
    {
        $contas_a_pagar = Consulta::montar($contas_a_pagar, $request->all())
            ->select([
                'contas_a_pagar.*',
                'sub_tipos_pagamentos.descricao as subtiposPagamento',
                'tipos_pagamentos.descricao as TipoPagamento',
                'centros_de_custo.descricao as centrosDeCustos',
                'fornecedores.nome as fornecedor',
            ])
            ->leftJoin('centros_de_custo', 'centros_de_custo.id', '=', 'contas_a_pagar.centro_de_custo_id')
            ->leftJoin('sub_tipos_pagamentos', 'sub_tipos_pagamentos.id', '=', 'contas_a_pagar.sub_tipo_pagamento_id')
            ->leftJoin('fornecedores', 'fornecedores.id', '=', 'contas_a_pagar.fornecedor_id')
            ->leftJoin('tipos_pagamentos', 'tipos_pagamentos.id', '=', 'sub_tipos_pagamentos.tipo_pagamento_id')
            ->get();

        return $contas_a_pagar;
    }

    public function datatable($contas_a_pagar)
    {
        return Datatables::of($contas_a_pagar)
            ->addColumn('action', function ($conta_a_pagar) {
                return '<td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="/admin/contas_a_pagar/' . $conta_a_pagar->id . '/edit"><i
                                                        class="icon-pencil5"></i> Editar Pagamento</a>
                                        </li>
                            
                                        <li>
                                            <a href="/admin/deleteContasAPagar/' . $conta_a_pagar->id . '"><i
                                                        class="icon-close2"></i> Excluir Pagamento</a>
                                        </li>
                    
                                    </ul>
                                </li>
                            </ul>
                        </td>';
            })->make(true);
    }



    public static function loadFormFields()
    {
        return [
            'tiposDespesas' => TipoDespesa::pluck('descricao', 'id'),
            'centrosDeCusto' => CentroDeCusto::pluck('descricao', 'id'),
            'tiposPagamentos' => TipoPagamento::pluck('descricao', 'id'),
            'subTiposPagamentos' => SubTipoPagamento::pluck('descricao', 'id'),
            'fornecedores' => Fornecedor::pluck('nome', 'id'),
            'contas_contabeis' => ContaContabil::all()->toArray(),
        ];
    }

    public function contaContabil()
    {
        return $this->belongsTo(ContaContabil::class, 'conta_id');
    }

    public function contaContabilValor()
    {
        return $this->belongsTo(ContaContabilValor::class, "conta_pagar_id");
    }

    public function tiposDespesas()
    {
        return $this->belongsTo(TipoDespesa::class, "tipo_despesa_id");
    }

    public function centrosDeCusto()
    {
        return $this->belongsTo(CentroDeCusto::class, 'centro_de_custo_id');
    }

    public function subtiposPagamentos()
    {
        return $this->belongsTo(SubTipoPagamento::class, "sub_tipo_pagamento_id");
    }

    public function fornecedores()
    {
        return $this->belongsTo(Fornecedor::class, "fornecedor_id");
    }

    public function concliacoes()
    {
        return $this->hasMany(ConciliacaoConta::class, "conta_pagar_id");
    }

    public function situacao()
    {
        return $this->belongsTo(Situacao::class, "situacao_id");
    }

    public function createAfterPgto($conta, $request)
    {
        $conta->contaContabilValor()
            ->updateOrCreate(
                [
                    'conta_pagar_id' => $conta->id
                ],
                [
                    'valor' => -Convert::moneyToDecimal($request['valor']),
                    'conta_id' => $request['conta_id'],
                    'data_pagamento' => $request['data_pagamento']
                ]);
    }
}
