<?php namespace App\Projeto\Financeiro;

use App\Helpers\Consulta;
use App\Helpers\FluentInterface;
use App\Projeto\Entity;
use Illuminate\Support\Facades\DB;

class ContaContabil extends Entity
{
    protected $table = "conta_contabil";

    protected $fillable = [
        'nome',
        'conta_id'
    ];

    public static function getFilhoTable($array)
    {


        foreach ($array as $item) {

            if (isset($item->filho)) {

                $valor = collect($item->filho)->sum('valor');



                dd($valor);

                self::getFilhoTable($array);
            } else {


            }


        }
    }

    public static function estruturarPlanoDeContas($planoDeContas, $idPai = null)
    {
        $planoEstruturado = [];

        foreach ($planoDeContas as $conta) {

            if ($conta->conta_id == $idPai) {

                $planoEstruturado[$conta->id] = $conta;

                $child = self::estruturarPlanoDeContas($planoDeContas, $conta->id);

                if ($child)

                    $planoEstruturado[$conta->id]->filho = $child;
            }
        }

        return $planoEstruturado;
    }


    public function consultaRecursiva()
    {

        $fluent = new FluentInterface();

        $query = $fluent->select(['sum(conta_contabil_valores.valor) as valor, conta_contabil.*'])
            ->from('conta_contabil')
            ->leftJoin('conta_contabil_valores', 'conta_contabil.id = conta_contabil_valores.conta_id')
            ->where('conta_contabil.deleted_at is null group by conta_contabil.id')
            ->getQuery();

        return DB::raw($query);
    }
}
