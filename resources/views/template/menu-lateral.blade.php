<!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    {{--<a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>--}}
                    <div class="media-body">
                        <span class="media-heading text-semibold">{{Auth::user()->nome}}</span>
                        <div class="text-size-mini text-muted">
                            <i class="icon-pin text-size-small"></i> &nbsp;Santa Ana, CA
                        </div>
                    </div>

                    <div class="media-right media-middle">
                        <ul class="icons-list">
                            <li>
                                <a href="#"><i class="icon-cog3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">


                    <li><a href="/"><i class="icon-home4"></i> <span>Início</span></a></li>
                    <li><a href="/funcionarios"><i class="icon-collaboration"></i> <span>Funcionários</span></a></li>
                    <li><a href="/clientes"><i class="icon-users4"></i> <span>Clientes</span></a></li>
                    <li><a href="/fornecedores"><i class="icon-truck"></i> <span>Fornecedores</span></a></li>
                    <li><a href="/produtos"><i class="icon-hammer-wrench"></i> <span>Produtos</span></a></li>
                    <li><a href="/servicos"><i class="icon-hammer-wrench"></i> <span>Serviços</span></a></li>
                    <li><a href="/contas_a_pagar"><i class="icon-coin-dollar"></i> <span>Contas a Pagar</span></a></li>
                    <li><a href="/contas_contabeis"><i class="icon-coins"></i> <span>Contas Contábeis</span></a></li>
                    <li><a href="/contas_bancarias"><i class="icon-cash3"></i> <span>Contas Bancárias</span></a></li>
                    <li><a href="/conciliacoes/filter"><i class="icon-cash2"></i> <span>Conciliações Bancárias</span></a></li>

                    <li>
                        <a href="#"><i class="icon-warning"></i> <span>Relatórios</span></a>
                        <ul>
                            <li><a href="/relatorios/relatorios_clientes"> <i class="icon-coins"></i> Clientes</a></li>
                            <li><a href="/relatorios/relatorios_vendas"> <i class="icon-coins"></i> Vendas</a></li>
                            <li><a href="/relatorios/relatorios_orcamentos"> <i class="icon-coins"></i> Orçamentos</a></li>
                            <li><a href="/relatorios/relatorios_produtos"> <i class="icon-coins"></i> Produtos</a></li>
                            <li><a href="/relatorios/relatorios_servicos"> <i class="icon-coins"></i> Serviços</a></li>
                            <li><a href="/relatorios/contas_a_pagar"> <i class="icon-coins"></i> Contas a Pagar</a></li>
                            <li><a href="/relatorios/contas_a_receber"> <i class="icon-coins"></i> Contas a Receber</a></li>
                            <li><a href="/relatorios/planos_de_contas"> <i class="icon-coins"></i> Plano de Contas</a></li>
                            <li><a href="/relatorios/relatorios_dre"> <i class="icon-coins"></i> DRE</a></li>
                            <li><a href="/relatorios/fluxo_de_caixa"> <i class="icon-coins"></i> Fluxo de Caixa</a></li>
                        </ul>
                    </li>
                    <!-- /page kits -->

                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->

