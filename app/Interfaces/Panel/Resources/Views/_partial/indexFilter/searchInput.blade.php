@if(!isset($search) || $search)
    <div class="col-sm-5 col-md-3 col-lg-3 pull-right">
        <div class="form-group has-feedback has-clear">
            <div class="input-group input-group-sm {{ $active_search ? 'active' : '' }}">
                <input type="text" name="search" class="form-control search {{ $active_search ? 'active' : '' }}" placeholder="Busca" value="{{ $active_search }}">
                <span class="input-group-btn">
                        <button class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
                    </span>
            </div>
            <span class="fa fa-remove form-control-feedback form-control-clear-search"></span>
        </div>
    </div>
@endif