<ul class="sidebar-menu">
    <li class="header">NAVEGAÇÃO</li>
@foreach($menu as $section => $item)
    @include('panel::_partial.mainMenu.item')
@endforeach
</ul>