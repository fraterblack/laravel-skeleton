@if($data->get('submenu'))
    <li class="{{ $data->get('active') ? 'active' : '' }} treeview" data-menu-item="{{ $identifier }}" data-depth="{{ $data->get('depth') }}">
        <a href="{{ $data->get('route') }}">
            {!! $data->get('icon') ? '<i class="' . $data->get('icon') . '"></i> ' : '' !!}
            <span>{{ $data->get('text') }}</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            @foreach($data->get('submenu') as $identifier => $data)
                @include('panel::_partial.mainMenu.item', ['is_section_item' => true])
            @endforeach
        </ul>
    </li>
@else
    <li class="{{ $data->get('active') ? 'active' : '' }} " data-menu-item="{{ $identifier }}" data-depth="{{ $data->get('depth') }}">
        <a href="{{ $data->get('route') }}"{!! $data->get('target') ? ' target="' . $data->get('target') . '"' : '' !!}>
            {!! $data->get('icon') ? '<i class="' . $data->get('icon') . '"></i> ' : '' !!}
            <span>{{ $data->get('text') }}</span>
        </a>
    </li>
@endif