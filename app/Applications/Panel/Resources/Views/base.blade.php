<!DOCTYPE html>
<html>
@include('panel::_head')
<?php
/*
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
*/
?>
<body data-token="{{ csrf_token() }}" class="hold-transition skin-yellow sidebar-mini layout-boxed" data-section="{{ !empty($section) ? $section : '' }}" data-section-item="{{ !empty($section_item) ? $section_item : '' }}">
    <div class="wrapper">
        @include('panel::header')

        @include('panel::sidebar')

        <div class="content-wrapper">
            @yield('contentWrapper')
        </div>

        @include('panel::footer')
        <div id="pageLoading" class="page-loading" data-toggle="tooltip" title="Carregando. Aguarde..."></div>
    </div>

    @include('panel::_foot')
    </body>
</html>