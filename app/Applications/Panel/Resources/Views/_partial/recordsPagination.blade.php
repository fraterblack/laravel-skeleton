<div class="row">
    <div class="col-xs-6">
        <div class="pagination-info text-sm">
            Mostrando {{ $records->total() }} registros em {{ $records->lastPage() }} páginas
        </div>
    </div>
    <div class="col-xs-6">
        <div class="pull-right">
            {!! $records->render() !!}
        </div>
    </div>
</div>