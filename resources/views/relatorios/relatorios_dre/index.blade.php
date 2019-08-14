@extends('template.template')
@section('content')
    <!-- Page header -->
    @include('shared.header', $paramns = [
         'nome' => 'Relatórios DRE',
         'breadcrum' => [
             [
                 'nome' => 'Relatórios DRE',
                 'url'  => ''
             ]
             ]
      ])
    <!-- /page header -->

    <!-- Conteúdo -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <legend class="text-bold">Preencha os campos abaixo</legend>
            <div class="content table-responsive table-full-width">


                <style>
                    .bld {
                        font-weight: bold;
                        font-size: 13px;
                        width: 200px;
                    }
                </style>


                <table class="table datatable-export tabelaMultinivel">
                    <thead>
                    <tr class="bld">
                        <th>Categorias</th>
                        <th>Total</th>
                    </tr>
                    </thead>


                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

<script>
    teste = <?php echo $array; ?>;
</script>

{!! Html::script('js/relatorios/datatableRelatorio.js')!!}

{!! Html::script('js/relatorios/planos_de_contas/tabela.js')!!}

@endpush
