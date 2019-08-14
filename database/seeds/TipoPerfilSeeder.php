<?php

use Illuminate\Database\Seeder;

class TipoPerfilSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipos_perfis')->insert([
            [
                'setor' => 'Atendimento',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'setor' => 'Administração',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'setor' => 'Operacional',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'setor' => 'Marketing',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}