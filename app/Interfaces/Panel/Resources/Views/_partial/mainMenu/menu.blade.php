<ul class="sidebar-menu">
    <li class="header">NAVEGAÇÃO</li>
@foreach($menu as $identifier => $data)
    @include('panel::_partial.mainMenu.item')
@endforeach
</ul>