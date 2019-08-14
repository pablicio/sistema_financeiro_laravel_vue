
<!DOCTYPE html>
<html>

@include('template.cabecalho')

<body>


<div class="wrapper">
    <!-- Sidebar Holder -->
@include('template.menu-lateral')

@include('template.menu-superior')

    <!-- Page Content Holder -->
    <div id="content">

        <div class="push"></div>

        <!-- Content area -->
        @include('template.container')
        <!-- /content area -->

        @include('template.rodape')

    </div>
</div>

</body>
</html>
