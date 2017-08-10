<input class="form-control input-sm text-input {{ $filter->has('active_filter') ? ' active' : '' }}"
       data-target-filter="#text_filter_{{ $loop->iteration }}"
       placeholder="{{ $filter['title'] }}"
       value="{{ $filter->has('active_filter') ? $filter->get('active_filter')->first()->get('value') : '' }}"
       type="text"
>
<input type="hidden"
       id="text_filter_{{ $loop->iteration }}"
       name="filter[]"
       data-column="{{ $filter['column'] }}"
       data-condition="{{ $filter['condition'] }}"
>