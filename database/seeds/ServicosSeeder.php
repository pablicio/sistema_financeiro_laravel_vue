<?php

use Illuminate\Database\Seeder;

class ServicosSeeder extends Seeder
{
    public function run()
    {
        DB::table('servicos')->insert([
            [
                'referencia' =>  '#123456',
                'nome' => 'Telefonia Personalizada',
                'valor' => '15',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'referencia' =>  '#123335',
                'nome' => 'MotoTaxi',
                'valor' => '5',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'referencia' =>  '#1233356',
                'nome' => 'Telefonia PABX',
                'valor' => '30',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'referencia' =>  '#122256',
                'nome' => 'SEDEX',
                'valor' => '35',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}