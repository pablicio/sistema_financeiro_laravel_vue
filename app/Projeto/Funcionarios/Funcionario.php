<?php namespace App\Projeto\Funcionarios;

use App\Projeto\Entity;
use App\Projeto\Sistema\Cidade;
use App\Projeto\Sistema\Estado;
use App\Transformers\FuncionarioTransformer;
use Yajra\Datatables\Datatables;

class Funcionario extends Entity
{
    protected $table = "funcionarios";

    protected $fillable = [
        'cidade_id',
        'estado_id',
        'tipo_perfil_id',
        'unidade_id',
        'nome',
        'email',
        'data_nascimento',
        'cpf',
        'cep',
        'endereco',
        'bairro'
    ];

    protected $convert = [
        'data_nascimento' => 'date',
        'cpf' => 'cpf',
        'fone' => 'fone',
        'cep' => 'cep'
    ];

    const COLUMNS_OF_DATATABLE = [
//        ['data' => 'cidade', 'name' => 'cidade', 'title' => 'Cidade'],
        ['data' => 'nome', 'name' => 'nome', 'title' => 'Nome'],
        ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
        ['data' => 'data_nascimento', 'name' => 'data_nascimento', 'title' => 'Data de Nascimento'],
        ['data' => 'cpf', 'name' => 'cpf', 'title' => 'Cpf'],
//        ['data' => 'cep', 'name' => 'cep', 'title' => 'Cep'],
//        ['data' => 'endereco', 'name' => 'endereco', 'title' => 'Endereço'],
//        ['data' => 'bairro', 'name' => 'bairro', 'title' => 'Bairro'],
        ['data' => 'action', 'name' => 'action', 'title' => 'Ações']
    ];

    public static function loadFormFields()
    {
        return [
            'estados' => Estado::pluck('nome', 'id'),

            'cidades' => Cidade::pluck('nome', 'id'),

            'tipos_perfis' => TipoPerfil::pluck('setor', 'id'),
        ];
    }

    public function datatable($funcionarios)
    {
        return Datatables::of($funcionarios)
            ->setTransformer(new FuncionarioTransformer)
            ->make(true);
    }

    public function dadosDatatable()
    {
        $funcionarios = Funcionario::select([
            'funcionarios.*',
            'cidades.nome as cidade',
            'tipos_perfis.setor as setor'
        ])->leftJoin('cidades', 'cidades.id', '=', 'funcionarios.cidade_id')
            ->leftJoin('tipos_perfis', 'tipos_perfis.id', '=', 'funcionarios.tipo_perfil_id')
            ->get();

        return $funcionarios;
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, "cidade_id");
    }

    public function telefones()
    {
        return $this->hasMany(FuncionarioTelefone::class, "funcionario_id");
    }

    public function tipoPerfil()
    {
        return $this->belongsTo(TipoPerfil::class, "tipo_perfil_id");
    }
}