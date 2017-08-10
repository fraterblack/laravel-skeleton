<div class="form-group has-feedback">
    <input class="form-control input-sm number-input mask-number {{ $filter->has('active_filter') ? ' active' : '' }}"
           data-target-filter="#number_filter_{{ $loop->iteration }}"
           placeholder="{{ $filter['title'] }}"
           value="{{ $filter->has('active_filter') ? $filter->get('active_filter')->first()->get('value') : '' }}"
           type="number"
    >
    <span class="fa fa-remove form-control-feedback form-control-clear-filter"></span>
</div>
<input type="hidden"
       id="number_filter_{{ $loop->iteration }}"
       name="filter[]"
       data-column="{{ $filter['column'] }}"
       data-condition="{{ $filter['condition'] }}"
>