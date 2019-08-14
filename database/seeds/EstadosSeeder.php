<?php

use Illuminate\Database\Seeder;

class EstadosSeeder extends Seeder
{
    public function run()
    {
        DB::table('estados')->insert([
            [
                'id' => '1',
                'nome' => 'Paraíba',
                'uf' => 'PB',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '2',
                'nome' => 'Pernambuco',
                'uf' => 'PE',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}