<?php namespace App\Projeto\Financeiro;


use App\Projeto\Clientes\Cliente;
use App\Projeto\Entity;
use App\Projeto\Produtos\Produto;
use App\Projeto\Servicos\Servico;
use App\Support\Convert;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Entity
{
    protected $table = "invoices";

    protected $fillable = [
        'cliente_id',
        'valor',
        'produto_id',
        'servico_id',
        'quantidade',
        'venda_id',

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

    public function contasAReceber()
    {
        return $this->hasMany(ContasAReceber::class, "invoice_id");
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, "cliente_id");
    }

    //Funcão de criação de invoices por item, ex: serviços e produtos, caso
    //deseje um novo item, basta adicionar mais um elif e registar o novo tipo
    //Alem de criar o campo nas migratios, é claro ;)

    public static function updateOrCreate($request, $venda)
    {
        foreach ($request as $key => $item) {
            $tipo = explode('-', $key);

            if (count($tipo) >= Invoice::ITEMVENDA) {
                $venda->invoices()->updateOrCreate(
                    [
                        $tipo[0] . '_id' => $item['id'],
                    ],
                    [
                        'quantidade' => $item['quantidade'],
                        'cliente_id' => $request['cliente_id'],
                        'venda_id' => $venda->id,
                        $tipo[0] . '_id' => $item['id'],
                        'valor' => $item['quantidade'] * Convert::moneyToDecimal($item['valor'])
                    ]);
            }
        }
    }


    public static function createInvoice($request, $venda)
    {
        foreach ($request as $key => $item) {

            $tipo = explode('-', $key);
            if (count($tipo) == Invoice::ITEMVENDA) {
                Invoice::create([
                    'quantidade' => $item['quantidade'],
                    'cliente_id' => $request['cliente_id'],
                    'venda_id' => $venda->id,
                    $tipo[0] . '_id' => $item['id'],
                    'valor' => $item['quantidade'] * Convert::moneyToDecimal($item['valor'])
                ]);
            }
        }
    }
}
