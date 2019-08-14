<?php

use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    public function run()
    {
        DB::table('clientes')->insert([
            [
                'cpf'                 => '934.098.098-08',
                'cidade_id'           => '1',
                'nome'                => 'João da Silva',
                'rg'                  => '331221 - SSP/PB',
                'email'               => 'joao1@outlook.com',
                'data_nascimento'     => date("Y-m-d"),
                'cep'                 => '58414-260',
                'endereco'            => 'Rua das Graças, 152',
                'bairro'              => 'Prata',
                'contribuinte_icms'   => '1',
                'observacao'          =>'teste observação',
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
            ],
            [
                'cpf'                 => '888.098.098-08',
                'cidade_id'           => '1',
                'nome'                => 'Paulo da Silva',
                'rg'                  => '89888 - SSP/PB',
                'email'               => 'paulo@outlook.com',
                'data_nascimento'     => date("Y-m-d"),
                'cep'                 => '77777-260',
                'endereco'            => 'Rua das Batoré, 152',
                'bairro'              => 'Liberdade',
                'contribuinte_icms'   => '1',
                'observacao'          =>'teste observação',
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
            ],
            [
                'cpf'                 => '999.098.098-08',
                'cidade_id'           => '1',
                'nome'                => 'Chico da Silva',
                'rg'                  => '331221 - SSP/PB',
                'email'               => 'chico@outlook.com',
                'data_nascimento'     => date("Y-m-d"),
                'cep'                 => '58414-260',
                'endereco'            => 'Rua das Imbuá, 152',
                'bairro'              => 'Ramadinha',
                'contribuinte_icms'   => '1',
                'observacao'          =>'teste observação',
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
            ],


        ]);
    }
}