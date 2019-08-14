<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('permissions')->insert([
            [
                'tipo' => 'users',
                'name' => 'users-show',
                'label' => 'Exibir Usuários',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'tipo' => 'users',
                'name' => 'users-create',
                'label' => 'Criar Usuários',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

            ],
            [
                'tipo' => 'users',
                'name' => 'users-update',
                'label' => 'Editar Usuários',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'tipo' => 'users',
                'name' => 'users-destroy',
                'label' => 'Deletar Usuários',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'tipo' => 'roles',
                'name' => 'roles-show',
                'label' => 'Exibir Roles',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'tipo' => 'roles',
                'name' => 'roles-create',
                'label' => 'Criar Roles',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

            ],
            [
                'tipo' => 'roles',
                'name' => 'roles-update',
                'label' => 'Editar Roles',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'tipo' => 'roles',
                'name' => 'roles-destroy',
                'label' => 'Deletar Roles',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'tipo' => 'permissions',
                'name' => 'permissions-show',
                'label' => 'Exibir Permissions',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'tipo' => 'permissions',
                'name' => 'permissions-create',
                'label' => 'Criar Permissions',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

            ],
            [
                'tipo' => 'permissions',
                'name' => 'permissions-update',
                'label' => 'Editar Permissions',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'tipo' => 'permissions',
                'name' => 'permissions-destroy',
                'label' => 'Deletar Permissions',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

        ]);


    }
}
