<header class="main-header">

    <a href="{{ route('admin.initial') }}" class="logo">
        <span class="logo-mini">ADM</span>
        <span class="logo-lg">by Nueva</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Alternar navegação</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="fa fa-user"></span> <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{--{{ route('home') }}--}}#" class="btn btn-default btn-flat"><span class="fa fa-search"></span> Visitar o Site</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('admin.auth.logout') }}" class="btn btn-flat btn-danger"><span class="fa fa-unlock"></span> Sair</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>