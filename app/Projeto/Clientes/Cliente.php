<?php namespace App\Projeto\Clientes;

use App\Helpers\Consulta;
use App\Notifications\OrcamentoNotification;
use App\Projeto\Entity;
use App\Projeto\Financeiro\ContasAReceber;
use App\Projeto\Financeiro\Orcamento;
use App\Projeto\Financeiro\Venda;
use App\Projeto\Sistema\Cidade;
use App\Projeto\Sistema\Estado;
use App\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use Yajra\Datatables\Facades\Datatables;

class Cliente extends Entity
{
    use Notifiable;

    protected $table = "clientes";

    protected $fillable = [
        'cidade_id',
        'nome',
        'rg',
        'email',
        'data_nascimento',
        'cep',
        'cpf',
        'cnpj',
        'razao_social',
        'endereco',
        'bairro',
        'contribuinte_icms',
        'observacao',
    ];

    protected $convert = [
        'data_nascimento' => 'date',
        'cep' => 'cep',
        'cpf' => 'cpf',
        'fone' => 'fone',
        'cnpj' => 'cnpj',
    ];

    const COLUMNS_OF_DATATABLE = [
        ['data' => 'nome', 'name' => 'nome', 'title' => 'Nome'],
        ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
        ['data' => 'rg', 'name' => 'rg', 'title' => 'Rg'],
        ['data' => 'data_nascimento', 'name' => 'data_nascimento', 'title' => 'Data de Nascimento'],
        ['data' => 'cpf', 'name' => 'cpf', 'title' => 'Cpf'],
        ['data' => 'cnpj', 'name' => 'cnpj', 'title' => 'CNPJ'],
        ['data' => 'cidade', 'name' => 'cidade', 'title' => 'Cidade'],
        ['data' => 'action', 'name' => 'action', 'title' => 'Ações']
    ];

    const COLUMNS_OF_DATATABLE_RELATORIO = [
        ['data' => 'nome', 'name' => 'nome', 'title' => 'Nome'],
        ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
        ['data' => 'rg', 'name' => 'rg', 'title' => 'Rg'],
        ['data' => 'data_nascimento', 'name' => 'data_nascimento', 'title' => 'Data de Nascimento'],
        ['data' => 'cpf', 'name' => 'cpf', 'title' => 'Cpf'],
        ['data' => 'cnpj', 'name' => 'cnpj', 'title' => 'CNPJ'],
        ['data' => 'cidade', 'name' => 'cidade', 'title' => 'Cidade'],
//        ['data' => 'action', 'name' => 'action', 'title' => 'Ações']
    ];


    public function datatableRelatorio($clientes)
    {
        return Datatables::of($clientes)->make(true);
    }

    public function dadosDatatableRelatorio($clientes, $request)
    {
        $clientes = Consulta::montar($clientes, $request->all())
            ->select('clientes.*', 'cidades.nome as cidade')
            ->leftJoin('cidades', 'cidades.id', '=', 'clientes.cidade_id')
            ->get();

        return $clientes;
    }


    public function datatable($clientes)
    {
        return Datatables::of($clientes)
            ->setTransformer(new ClienteTransformer)
            ->make(true);
    }

    public function dadosDatatable()
    {
        $clientes = Cliente::select([
            'clientes.*',
            'cidades.nome as cidade'

        ])
            ->leftJoin('cidades', 'cidades.id', '=', 'clientes.cidade_id')
            ->get();

        return $clientes;
    }



    public function orcamentos()
    {
        return $this->hasMany(Orcamento::class ,"cliente_id");
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class ,"cliente_id");
    }

    public function servicos()
    {
        return $this->hasMany(ClienteServico::class ,"cliente_id");
    }

    public function produtos()
    {
        return $this->hasMany(ClienteProduto::class, "cliente_id");
    }

    public static function loadFormFields()
    {
        return [
            'estados' => Estado::pluck('nome', 'id'),
        ];
    }

    public function user()
    {
        return $this->hasOne(User::class, 'cliente_id');
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, "cidade_id");
    }

    public function telefones()
    {
        return $this->hasMany(ClienteTelefone::class, "cliente_id");
    }

    public function sendOrcamento($pdf,$orcamento)
    {
        Notification::send($this, new OrcamentoNotification($pdf,$orcamento));
    }

    public function contasAReceber()
    {
        return $this->hasMany(ContasAReceber::class, "cliente_id");
    }
}
