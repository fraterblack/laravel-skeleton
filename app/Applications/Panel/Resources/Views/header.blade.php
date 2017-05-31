<header class="main-header">

    <a href="{{ route('admin.initial') }}" class="logo">
        <span class="logo-mini">PA</span>
        <span class="logo-lg"><small>Painel Administrativo</small></span>
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
                <li>
                    <a href="{{ route('initial') }}" target="_blank">
                        Ir para o Site <span class="label label-info"><span class="fa fa-search"></span></span>
                    </a>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="fa fa-user"></span> <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <div class="text-center">
                                <a href="{{ route('admin.myAccount.edit') }}" class="btn btn-default"><span class="fa fa-gear"></span> Editar meu Cadastro</a>
                            </div>
                            <hr>
                            <div class="pull-right">
                                <a href="{{ route('admin.auth.logout') }}" class="btn btn-danger btn-xs bg-red"><span class="fa fa-unlock"></span> Sair</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>