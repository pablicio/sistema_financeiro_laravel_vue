@extends('template.template')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="error-container">
                <div class="well">
                    <h1 class="grey lighter smaller">
											<span class="blue bigger-125">
												<i class="ace-icon fa fa-sitemap"></i>
												403
											</span>
                        Usuário não autorizado!
                    </h1>

                    <hr />
                    <h3 class="lighter smaller">Desculpe! Você não tem permissão para está parte do sistema!</h3>

                    <div>
                        <form class="form-search">
												<span class="input-icon align-middle">
													<i class="ace-icon fa fa-search"></i>

													<input type="text" class="search-query" placeholder="Give it a search..." />
												</span>
                            <button class="btn btn-sm" type="button">Go!</button>
                        </form>

                        <div class="space"></div>
                        <h4 class="smaller">Instruções: </h4>

                        <ul class="list-unstyled spaced inline bigger-110 margin-15">
                            <li>
                                <i class="ace-icon fa fa-hand-o-right blue"></i>
                                Entre em contato com o administrador.
                            </li>

                            <li>
                                <i class="ace-icon fa fa-hand-o-right blue"></i>
                                verifique no departamento responsável.
                            </li>

                            <li>
                                <i class="ace-icon fa fa-hand-o-right blue"></i>
                                Ou simplesmente você não deve acessar esta parte do sistema.
                            </li>
                        </ul>
                    </div>

                    <hr />
                    <div class="space"></div>

                    <div class="center">
                        <a href="javascript:history.back()" class="btn btn-grey">
                            <i class="ace-icon fa fa-arrow-left"></i>
                            Voltar
                        </a>

                        <a href="/home" class="btn btn-primary">
                            <i class="ace-icon fa fa-tachometer"></i>
                            Inicio
                        </a>
                    </div>
                </div>
            </div>

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->

@endsection
