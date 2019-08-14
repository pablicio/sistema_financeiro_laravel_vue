<?php

use Illuminate\Database\Seeder;

class ContaBancariaSeeder extends Seeder
{
    public function run()
    {
        DB::table('contas_bancarias')->insert([
            [
                'banco_id' => '1',
                'agencia' => '8551-5',
                'conta' => '1555885-9',
                'favorecido' => 'bb',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'banco_id' => '1',
                'agencia' => '5555-5',
                'conta' => '1555885-9',
                'favorecido' => 'bb',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'banco_id' => '2',
                'agencia' => '5555-5',
                'conta' => '1555885-9',
                'favorecido' => 'itau',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'banco_id' => '3',
                'agencia' => '8888-5',
                'conta' => '777777-9',
                'favorecido' => 'conta bradesco',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'banco_id' => '4',
                'agencia' => '44444-5',
                'conta' => '6664444-9',
                'favorecido' => 'conta santander',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}