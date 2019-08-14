<?php

use Illuminate\Database\Seeder;

class DiasPagamentoSeeder extends Seeder
{
    public function run()
    {
        DB::table('dias_pagamentos')->insert([
            [
                'dia_pagamento' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'dia_pagamento' => '10',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'dia_pagamento' => '20',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}