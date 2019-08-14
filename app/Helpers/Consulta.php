<?php namespace App\Helpers;

use Carbon\Carbon;

class Consulta
{
    public static function montar($entity, array $data)
    {
        $campos = collect($entity->getFillable())->merge(['created_at']);

        $camposForm = TrataArray::array_filter_recursive($data);

        $campos->each(function ($campo) use ($camposForm, &$entity) {

            if (isset($camposForm[$campo])) {

                if (isset($camposForm[$campo]['date'])) {

                    if (count($camposForm[$campo]['date']) == 1) {
                        $entity = $entity->whereDate($campo, $camposForm[$campo]['date'][0]);

                    } else {
                        $entity = $entity->whereDate($campo, ">=", Carbon::createFromFormat('d/m/Y',$camposForm[$campo]['date'][0])->toDateString())
                                         ->whereDate($campo, "<=", Carbon::createFromFormat('d/m/Y',$camposForm[$campo]['date'][1])->toDateString());

                    }
                }
                if (isset($camposForm[$campo]['int'])) {

                    $entity = $entity->where($campo, $camposForm[$campo]['int']);
                }

            }
        });

        return $entity;
    }
}