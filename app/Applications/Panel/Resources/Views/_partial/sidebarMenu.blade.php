<ul class="sidebar-menu">
    <li class="header">NAVEGAÇÃO</li>
    <li data-section="dashboard"><a href="{{ route('admin.initial') }}"><i class="fa fa-bar-chart"></i> <span>Painel</span></a></li>

    <li class="treeview" data-section="users">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i> <span>Usuários</span>{{-- <i class="fa fa-angle-left pull-right"></i>--}}</a>
    </li>

    <li class="treeview" data-section="cms">
        <a href="{{ route('admin.pages.index') }}"><i class="fa fa-edit"></i> <span>CMS</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li data-section-item="contacts"><a href="{{ route('admin.contacts.index') }}">Contatos</a></li>
            <li data-section-item="pages"><a href="{{ route('admin.pages.index') }}">Páginas</a></li>
            <li data-section-item="banners"><a href="{{ route('admin.banners.index') }}">Banners</a></li>
        </ul>
    </li>

    <li class="treeview" data-section="configurations">
        <a href="#"><i class="fa fa-gears"></i> <span>Configurações</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li data-section-item="contactRecipients"><a href="{{ route('admin.contactRecipients.index') }}">Destinatários de Contato</a></li>
            <li class="header text-danger">Configurações Avançadas</li>
            <li data-section-item="bannerPlaces"><a href="{{ route('admin.bannerPlaces.index') }}">Locais de Banners</a></li>
            <li data-section-item="cacheControl"><a href="{{ route('admin.utils.cacheControl') }}">Cache</a></li>
        </ul>
    </li>
</ul>