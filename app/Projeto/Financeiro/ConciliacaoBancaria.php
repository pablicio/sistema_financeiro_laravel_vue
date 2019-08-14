<?php namespace App\Projeto\Financeiro;

use App\Projeto\Entity;

class ConciliacaoBancaria extends Entity
{
    protected $table = "conciliacoes_bancarias";

    protected $fillable = [
        'conta_bancaria_id',
        'data_deposito',
        'tipo_deposito',
        'fitid',
        'memo',
        'valor',
        'situacao_id',
        'ofx_id'
    ];

    protected $convert = [
        'data_deposito' => 'date',
    ];

    const STATUS_A_CONCILIAR = 9;

    const STATUS_CONCILIADO = 10;

    const TIPO_PAGAR = 0;

    const TIPO_RECEBER = 1;


    public function somaSistema($conciliacoes)
    {
        $conciliacoes->join('conciliacoes_contas', 'conciliacoes_contas.conciliacao_id', '=', 'conciliacoes_contas.id')
            ->sum('valor');

        return $conciliacoes;
    }







    public function ofx2()
    {
        return $this->belongsTo(ConciliacaoOfx::class, "ofx_id");
    }


    public function pagamentos()
    {
        return $this->hasMany(ContasAPagar::class, "tipo_despesa_id");
    }

    public function conta()
    {
        return $this->belongsTo(ContaBancaria::class, 'conta_bancaria_id');
    }

    public function situacao()
    {
        return $this->belongsTo(Situacao::class, 'situacao_id');
    }

    public function conciliacoesConta()
    {
        return $this->hasMany(ConciliacaoConta::class, "conciliacao_id");
    }

    public function ofxRecordsFilter($transactions, $request, $OfxObjId)
    {
        $ofx_records = [];

        foreach ($transactions as $conciliacao) {

            $ofx_records[] = [
                'ofx_id' => $OfxObjId,
                'situacao_id' => ConciliacaoBancaria::STATUS_A_CONCILIAR,
                'conta_bancaria_id' => $request['banco_id'],
                'data_deposito' => $conciliacao->date->format("Y-m-d"),
                'tipo_deposito' => $conciliacao->type,
                'fitid' => $conciliacao->uniqueId,
                'memo' => utf8_decode($conciliacao->memo),
                'valor' => $conciliacao->amount,
                'checknum' => $conciliacao->checkNumber[0],
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        $ofx_collection = collect($ofx_records);

        $records_in_db = self::whereIn('fitid', $ofx_collection->pluck('fitid')
            ->toArray())
            ->pluck('fitid')
            ->toArray();

        $filtered = $ofx_collection->reject(function ($value) use ($records_in_db) {

            return in_array($value['fitid'], $records_in_db);

        });

        return $filtered->all();
    }

    public function getContaByTipo($conciliacao)
    {
        if ($conciliacao->valor < ConciliacaoBancaria::TIPO_PAGAR) {

            $tipo = ConciliacaoBancaria::TIPO_PAGAR;

            $contas = new ContasAPagar();

        } else {

            $tipo = ConciliacaoBancaria::TIPO_RECEBER;

            $contas = new ContasAReceber();
        }

        return [$contas, $tipo];
    }

    public function associaConciliacoes($request)
    {
        $associacoes = [];

        foreach ($request['contas'] as $conta) {

            if ($request['tipo'] == 0) {

                array_push($associacoes, [
                    'conciliacao_id' => $request['conciliacao_id'],
                    'conta_pagar_id' => $conta
                ]);

            } elseif ($request['tipo'] == 1) {

                array_push($associacoes, [
                    'conciliacao_id' => $request['conciliacao_id'],
                    'conta_receber_id' => $conta
                ]);

            }
        }
        return $associacoes;
    }

    public static function ofx($ofx_path)
    {
        $ofxParser = new \OfxParser\Parser();

        $ofx = $ofxParser->loadFromFile($ofx_path);

        $bankAccount = reset($ofx->bankAccounts);

        return $bankAccount;

    }
}
