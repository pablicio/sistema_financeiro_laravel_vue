<?php

use Illuminate\Database\Seeder;

class FuncionariosSeeder extends Seeder
{
    public function run()
    {
        DB::table('funcionarios')->insert([
            [
                'cidade_id'          => '1',
                'tipo_perfil_id'     => '1',
                'nome'               => 'José',
                'data_nascimento'    => '1995-12-16',
                'email'              => 'jose@gmail.com',
                'cpf'                => '5555-66788',
                'cep'                => '58444-333',
                'endereco'           => 'BR. 230, Km. 12',
                'bairro'             => 'Loteamento Cidade Verde',
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'unidade_id'         => '2',
                'cidade_id'          => '2',
                'nome'               => 'Clarice',
                'data_nascimento'    => '1974-08-16',
                'email'              => 'clarice@gmail.com',
                'cpf'                => '855889-66788',
                'cep'                => '58777-222',
                'endereco'           => 'Rua das Flores',
                'bairro'             => 'Matilde Severiano',
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],

        ]);
    }
}