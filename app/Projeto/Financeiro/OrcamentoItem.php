<?php namespace App\Projeto\Financeiro;


use App\Projeto\Clientes\Cliente;
use App\Projeto\Entity;
use App\Projeto\Produtos\Produto;
use App\Projeto\Servicos\Servico;
use App\Support\Convert;

class OrcamentoItem extends Entity
{
    protected $table = "orcamentos_itens";

    protected $fillable = [
        'cliente_id',
        'orcamento_id',
        'valor',
        'produto_id',
        'servico_id',
        'quantidade',
    ];

    protected $convert = [
        'valor' => 'money',
    ];

    const ITEMVENDA = 2;

    const CREDITO = 0;

    const DEBITO = 1;

    public function produto()
    {
        return $this->belongsTo(Produto::class, "produto_id");
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class, "servico_id");
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, "cliente_id");
    }

    //Funcão de criação de invoices por item, ex: serviços e produtos, caso
    //deseje um novo item, basta adicionar mais um elif e registar o novo tipo
    //Alem de criar o campo nas migratios, é claro ;)

    public static function updateOrCreateOrcamentoItem($request, $orcamento)
    {
        foreach ($request as $key => $item) {
            $tipo = explode('-', $key);

            if (count($tipo) >= OrcamentoItem::ITEMVENDA) {
                $orcamento->orcamentoItem()->updateOrCreate(
                    [
                        $tipo[0] . '_id' => $item['id'],
                    ],
                    [
                        'quantidade' => $item['quantidade'],
                        'cliente_id' => $request['cliente_id'],
                        'orcamento_id' => $orcamento->id,
                        $tipo[0] . '_id' => $item['id'],
                        'valor' => $item['quantidade'] * Convert::moneyToDecimal($item['valor'])
                    ]);
            }
        }
    }


    public static function createOrcamentoItem($request, $orcamento)
    {
        foreach ($request as $key => $item) {

            $tipo = explode('-', $key);
            if (count($tipo) == OrcamentoItem::ITEMVENDA) {
                OrcamentoItem::create([
                    'quantidade' => $item['quantidade'],
                    'cliente_id' => $request['cliente_id'],
                    'orcamento_id' => $orcamento->id,
                    $tipo[0] . '_id' => $item['id'],
                    'valor' => $item['quantidade'] * Convert::moneyToDecimal($item['valor'])
                ]);
            }
        }
    }
}
