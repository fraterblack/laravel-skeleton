<form class="row search-form-of-records" action="{{ Request::url() }}">
    @include('panel::_partial.indexFilter.searchInput')

    @if(! empty($filters))
        @php
            $totalFilters = count($filters);

            //Define o tamanho do filtro conforme a quantidade de filtros setados
            if ($totalFilters == 1) {
                $filterWidth = 'col-sm-6 col-md-5 col-lg-3';
            } elseif ($totalFilters == 2) {
                $filterWidth = 'col-sm-4 col-md-4 col-lg-3';
            } else {
                $filterWidth = 'col-sm-4 col-md-3 col-lg-2';
            }
        @endphp
        @foreach($filters as $filter)
            <div class="{{ $filterWidth }} {{ $filter['type'] }}-filter-container pull-right">
                <div class="form-group">
                @if($filter['type'] == 'date')
                    @include('panel::_partial.indexFilter.dateInput')
                @elseif($filter['type'] == 'date-range')
                    @include('panel::_partial.indexFilter.dateRangeInput')
                @elseif($filter['type'] == 'number')
                    @include('panel::_partial.indexFilter.numberInput')
                @elseif($filter['type'] == 'text')
                    @include('panel::_partial.indexFilter.textInput')
                @elseif($filter['type'] == 'select')
                    @include('panel::_partial.indexFilter.selectInput')
                @else
                    {!! '<span class="text-danger">Tipo de filtro <strong>' . $filter['type'] . '</strong> é inválido</span>' !!}
                @endif
                </div>
            </div>
        @endforeach
    @endif
    <input type="hidden" class="orderBy" name="orderBy" value="{{ $active_order_by }}" />
    <input type="hidden" class="sortedBy" name="sortedBy" value="{{ $active_sorted_by }}" />
</form>