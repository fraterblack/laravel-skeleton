@if($item->get('submenu'))
    <li class="treeview" data-section="{{ $section }}">
        <a href="{{ $item->get('route') }}">
            {!! $item->get('icon') ? '<i class="' . $item->get('icon') . '"></i> ' : '' !!}
            <span>{{ $item->get('text') }}</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            @foreach($item->get('submenu') as $section => $item)
                @include('panel::_partial.mainMenu.item', ['is_section_item' => true])
            @endforeach
        </ul>
    </li>
@else
    <li data-section{{! empty($is_section_item) ? '-item' : ''}}="{{ $section }}">
        <a href="{{ $item->get('route') }}"{!! $item->get('target') ? ' target="' . $item->get('target') . '"' : '' !!}>
            {!! $item->get('icon') ? '<i class="' . $item->get('icon') . '"></i> ' : '' !!}
            <span>{{ $item->get('text') }}</span>
        </a>
    </li>
@endif