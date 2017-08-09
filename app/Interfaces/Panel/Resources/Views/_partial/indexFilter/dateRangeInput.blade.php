@php
    $initialDate = '';
    if ($filter->has('active_filter')) {
        $initialDate .= $filter->get('active_filter')->first()->get('value')->format('d/m/Y');

        $initialDate .= ! empty($filter->get('active_filter')->get(2)) ? ' - ' . $filter->get('active_filter')->get(2)->get('value')->format('d/m/Y') : '';
    }
@endphp
<div class="form-group has-feedback">
    <input class="form-control input-sm date-range-input mask-date-range date-range-picker no-placeholder {{ $filter->has('active_filter') ? ' active' : '' }}"
           data-target-filter="#date_filter_{{ $loop->iteration }}"
           placeholder="{{ $filter['title'] }}"
           value="{{ $initialDate }}"
           type="text"
    >
    <span class="fa fa-remove form-control-feedback form-control-clear-filter"></span>
</div>

<input type="hidden"
       id="date_filter_{{ $loop->iteration }}_1"
       name="filter[]"
       data-column="{{ $filter['column'] }}"
>
<input type="hidden"
       id="date_filter_{{ $loop->iteration }}_2"
       name="filter[]"
       data-column="{{ $filter['column'] }}"
>