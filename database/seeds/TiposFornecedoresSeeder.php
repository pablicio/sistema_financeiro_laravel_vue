<?php

use Illuminate\Database\Seeder;

class TiposFornecedoresSeeder extends Seeder
{
    public function run()
    {
        DB::table('fornecedores_tipos')->insert([
            [
                'descricao' => 'Órgão Público',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'descricao' => 'Empresa Privada',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}