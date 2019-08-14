<?php

use Illuminate\Database\Seeder;

class FornecedoresSeeder extends Seeder
{
    public function run()
    {
        DB::table('fornecedores')->insert([
            [
                'cidade_id'          => '1',
                'tipo_fornecedor_id' => '1',
                'nome'               => 'Projecta Material de Construção',
                'cpf'                => '5555',
                'rg'                 => '344',
                'email'              => 'projecta@gmail.com',
                'cep'                => '58444-333',
                'endereco'           => 'BR. 230, Km. 12',
                'bairro'             => 'Loteamento Cidade Verde',
                'observacao'         => 'observação teste',
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'cidade_id'          => '2',
                'tipo_fornecedor_id' => '2',
                'nome'               => 'João Pintor',
                'cpf'                => '334123',
                'rg'                 => '44444123',
                'email'              => 'joaopintor@gmail.com',
                'cep'                => '58444-333',
                'endereco'           => 'Rua João Pessoa, 32123',
                'bairro'             => 'Centro',
                'observacao'         => 'observação joão pintor',
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}