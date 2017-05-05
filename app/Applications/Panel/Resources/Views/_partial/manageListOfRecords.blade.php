<form class="row search-form-of-records" action="{{ Request::url() }}">

    @if(!isset($search) || $search)
        <div class="col-sm-5 col-md-3 col-lg-3 pull-right">
            <div class="form-group has-feedback has-clear">
                <div class="input-group input-group-sm">
                    <input name="search" type="text" class="form-control search {{ Request::has('search') ? 'active' : '' }}" placeholder="Busca" value="{{ Request::get('search') }}">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                </div>
                {!! Request::has('search') ? '<a class="fa fa-remove form-control-feedback form-control-clear-search"></a>' : '' !!}
            </div>
        </div>
    @endif

    @if(!empty($filters))
        @php
            $totalFilters = count($filters);

            //Define o tamanho do filtro conforme a quantidade de filtros setados
            if ($totalFilters == 1) {
                $filterSize = 'col-sm-6 col-md-5 col-lg-3';
            } elseif ($totalFilters == 2) {
                $filterSize = 'col-sm-4 col-md-4 col-lg-3';
            } else {
                $filterSize = 'col-sm-4 col-md-3 col-lg-2';
            }

            //Filtros ativos
            $filterValues = !empty(Request::get('filter')) ? Request::get('filter') : [];
        @endphp
        @foreach($filters as $filter)
            @php
                $hasFilter = array_filter($filterValues, function ($item) use ($filter) {
                    if (stripos($item, $filter['column']) !== false) {
                        return true;
                    }

                    return false;
                });

                sort($hasFilter);
            @endphp
            <div class="{{ $filterSize }} pull-right">
                <div class="form-group">
                    <select name="filter[]"
                            class="form-control input-sm {{ !empty($hasFilter) ? ' has-filter' : '' }} {{ ($filter['remote_search'] ? 'remoteSearchToFilter' : ($filter['multiple'] ? ' multipleSelect2' : 'defaultSelect2')) }}"
                            data-placeholder="{{ $filter['title'] }}"{{ ($filter['multiple']) ? ' multiple' : '' }}
                            data-column="{{ $filter['column'] }}" data-condition="{{ $filter['condition'] }}"
                            @if($filter['remote_search'])
                                data-search-url="{{ $filter['remote_search'] }}" data-initial-id="{{ !empty($hasFilter) ? $hasFilter[0] : '' }}"
                            @endif
                    >
                        @if(!$filter['multiple'])
                            <option value="">Selecione</option>
                        @endif
                        @foreach($filter['options'] as $value=>$name)
                            <?php
                                $value = $filter['column'] . '.' . $filter['condition'] . '.' . $value;
                            ?>
                            <option value="{{ $value }}"{{ (!empty($hasFilter) && $value == $hasFilter[0]) ? ' selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endforeach
    @endif

    <input type="hidden" class="orderBy" name="orderBy" value="{{ Request::get('orderBy') }}" />
    <input type="hidden" class="sortedBy" name="sortedBy" value="{{ Request::get('sortedBy', 'desc') }}" />
</form>