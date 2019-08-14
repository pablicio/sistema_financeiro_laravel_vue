<!DOCTYPE html>
<html>

@include('template.cabecalho')

<body>


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">
        <!-- Sidebar Holder -->
    @include('template.menu-lateral')

    @include('template.menu-superior')

    <!-- Page Content Holder -->
        <div class="content">

            <div class="push"></div>

            <!-- Content area -->
        @include('template.container')
        <!-- /content area -->

            @include('template.rodape')

        </div>
    </div>
</div>
</body>
</html>
