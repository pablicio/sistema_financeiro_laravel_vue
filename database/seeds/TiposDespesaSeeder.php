<?php

use Illuminate\Database\Seeder;

class TiposDespesaSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipos_despesas')->insert([
            [
                'unidade_id' => '1',
                'descricao' => 'Fixa',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'unidade_id' => '1',
                'descricao' => 'Variável',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

        ]);
    }
}