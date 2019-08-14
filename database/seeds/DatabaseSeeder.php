<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CidadesSeeder::class);
        $this->call(EstadosSeeder::class);
        $this->call(FormaPagamentoSeeder::class);
        $this->call(ProdutosSeeder::class);
        $this->call(ServicosSeeder::class);
        $this->call(TipoPerfilSeeder::class);
        $this->call(BancosSeeder::class);
        $this->call(CartoesSeeder::class);
        $this->call(FuncionariosSeeder::class);
        $this->call(ContaContabilSeeder::class);
        $this->call(ContasAPagarSeeder::class);
        $this->call(TiposDespesaSeeder::class);
        $this->call(TiposFornecedoresSeeder::class);
        $this->call(TiposPagamentoSeeder::class);
        $this->call(SubTiposPagamentoSeeder::class);
        $this->call(FornecedoresSeeder::class);
        $this->call(SituacaoSeeder::class);
        $this->call(ClientesSeeder::class);
        $this->call(CentroDeCustoSeeder::class);
        $this->call(BancosSeeder::class);


    }
}
