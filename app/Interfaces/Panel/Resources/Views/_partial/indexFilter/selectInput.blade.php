@php
    //Options attributes origin from controller
    $selectOptions = isset($filter['options']['select_options']) ? $filter['options']['select_options'] : null;
    $multipleSelection = isset($filter['options']['multiple_selection']) ? $filter['options']['multiple_selection'] : null;
    $remoteSearch = isset($filter['options']['remote_search']) ? $filter['options']['remote_search'] : null;
@endphp
<select name="filter[]"
        id="date_filter_{{ $loop->iteration }}"
        class="form-control input-sm {{ $filter->has('active_filter') ? ' has-filter' : '' }} {{ $remoteSearch ? 'remoteSearchToFilter' : ($multipleSelection ? ' multipleSelect2' : 'defaultSelect2') }}"
        data-placeholder="{{ $filter['title'] }}"{{ $multipleSelection ? ' multiple' : '' }}
        data-column="{{ $filter['column'] }}" data-condition="{{ $filter['condition'] }}"
    @if($remoteSearch)
        data-search-url="{{ $remoteSearch }}" data-initial-id="{{ $filter->has('active_filter') ? $filter->get('active_filter')->first()->get('value') : '' }}"
    @endif
>
@if(! $multipleSelection)
    <option value="">Selecione</option>
@endif
@if($selectOptions)
    @foreach($selectOptions as $value => $name)
        @php
            $value = $filter['column'] . '.' . $filter['condition'] . '.' . $value;
        @endphp
        <option value="{{ $value }}"
                {{ ($filter->has('active_filter') && $value == $filter->get('active_filter')->first()->get('sentence')) ? ' selected' : '' }}
        >{{ $name }}</option>
    @endforeach
@endif
</select>