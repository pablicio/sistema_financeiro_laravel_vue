<?php

use Illuminate\Database\Seeder;

class CentroDeCustoSeeder extends Seeder
{
    public function run()
    {
        DB::table('centros_de_custo')->insert([
            [

                'descricao' => 'Administrativo',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [

                'descricao' => 'Financeiro',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [

                'descricao' => 'Externo',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [

                'descricao' => 'Empresas Parceiras',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

        ]);
    }
}