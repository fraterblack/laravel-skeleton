<!DOCTYPE html>
<html>
@include('panel::_head')
<body class="hold-transition login-page">
    @include('panel::_foot')

        <div class="login-box">
            <div class="login-logo">
                <a href="{{ config('app.url') }}"><img src="{{ config('app.panel.contractor.logo') }}" alt="{{ config('app.panel.contractor.name') }}"></a>
            </div>
            @yield('contentWrapper')
        </div>
        <div id="pageLoading" class="page-loading" data-toggle="tooltip" title="Carregando. Aguarde..."></div>
    @include('panel::_foot')
    </body>
</html>