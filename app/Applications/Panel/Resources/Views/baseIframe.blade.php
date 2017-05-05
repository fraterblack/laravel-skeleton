<!DOCTYPE html>
<html>
    @include('panel::_head')
    <body class="base-iframe" data-token="{{ csrf_token() }}">
        <div class="wrapper">
            <div class="content-wrapper">
                @yield('contentWrapper')
            </div>
            <div id="pageLoading" class="page-loading" data-toggle="tooltip" title="Carregando. Aguarde..."></div>
        </div>
        @include('panel::_foot')
    </body>
</html>