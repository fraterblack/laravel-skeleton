<div class="ui error small message"></div>
<div class="row">
    <div class="field required form-group col-md-6">
        {!! Form::label('name', 'Nome') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'data-rule' => 'empty']) !!}
    </div>
</div>

<div class="row">
    <div class="field required col-xs-12">
        {!! Form::label('banner_place_id', 'Localização') !!}
    </div>
    <div class="field form-group col-md-6 col-lg-4">
        <select data-rule="empty" class="form-control" id="banner_place_id" name="banner_place_id">
            <option value="">Selecione</option>
            @foreach($places as $place)
                <option value="{{ $place->id }}"
                        data-accepted-types="{{ implode(',', $place->accepted_types) }}"
                        data-map-image="{{ $place->present()->getUrlImage('original') }}"
                        {{ ((!empty($banner) && $banner->banner_place_id == $place->id) || old('banner_place_id') == $place->id) ? ' selected' : '' }}
                >{{ $place->name }}: &nbsp;&nbsp;{{ ($place->width > 0) ? $place->width : 'auto' }}x{{ ($place->height > 0) ? $place->height : 'auto' }} pixels</option>
            @endforeach
        </select>
    </div>
    <div class="field form-group col-md-6 col-lg-4">
        <button id="showBannerMap" class="btn btn-xs" href="{{ !empty($banner) ? $banner->place->present()->getUrlImage('original') : '' }}" data-rel="lightbox"><span class="fa fa-search"></span> Ver Localização</button>
    </div>
</div>

<div id="bannerConfigInputsContainer" class="initially-hidden">
    <div class="row">
        <div class="field required col-xs-12">
            {!! Form::label('type', 'Tipo de Banner') !!}
        </div>
        <div class="form-group col-xs-12">
            @foreach($types as $code => $name)
                <label class="enabled-banner-type {{ $code }}" style="display: none">
                    {!! Form::radio('type', $code, (!empty($banner) && $banner->type == $code) ? true : null, ['class' => 'custom-checkbox']) !!} {{ $name }}
                </label>
            @endforeach
        </div>
    </div>

    <div id="bannerImageInputs" class="ui segment initially-hidden">
        <div class="row">
            <div class="field form-group col-md-7 col-lg-5">
                <div class="box box-widget form-group">
                    <div class="field required box-header">
                        {!! Form::label('image', 'Imagem do Banner') !!}
                    </div>
                    @if(!empty($banner) && $banner->present()->getUrlImage('thumb'))
                        <div class="box-body">
                            <a data-rel="lightbox" href="{{ $banner->present()->getUrlImage() }}">
                                <img src="{{ $banner->present()->getUrlImage('thumb') }}" alt=""/>
                            </a>
                        </div>
                    @endif
                    <div class="box-footer">
                        {!! Form::file('image') !!}
                    </div>
                </div>
            </div>

            <div class="field form-group col-sm-6 col-md-3 col-lg-2">
                {!! Form::label('background_color', 'Cor de Fundo', ['data-title' => 'Não se aplica em todos os locais', 'data-toggle' => 'tooltip']) !!}
                <div class="input-group colorpicker-input">
                    {!! Form::text('background_color', !empty($banner) ? null : '', ['class' => 'form-control mask-hexacolor', 'max-length' => '7']) !!}
                    <span class="input-group-addon"><i></i></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="field form-group col-xs-12 col-md-6 col-lg-5">
                {!! Form::label('url', 'URL') !!}
                {!! Form::text('url', null, ['class' => 'form-control mask-url', 'data-rule' => 'url', 'data-rule-optional' => 'true']) !!}
                <p class="help-block">Informe um URL se deseja habilitar link no banner</p>
            </div>
            <div class="field form-group col-xs-12 col-md-2 col-sm-12">
                {!! Form::label('open_in_new_window', 'Abrir em Nova Janela') !!}
                {!! Form::select('open_in_new_window', ['0' => 'Não', '1' => 'Sim'], isset($banner) ? $banner->open_in_new_window : null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div id="bannerHtmlInputs" class="ui segment initially-hidden">
        <div class="row">
            <div class="field required form-group col-xs-12 col-lg-12">
                {!! Form::label('code', 'Código HTML do Banner') !!}
                {!! Form::textarea('code', null, [
                    'class' => 'form-control',
                    'rows' => '10'
                ]) !!}
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="field required form-group col-xs-5 col-sm-3 col-md-2">
        {!! Form::label('availability_from', 'Mostrar de', ['data-title' => 'A partir desta data o banner começará a ser exibido', 'data-toggle' => 'tooltip']) !!}
        {!! Form::text('availability_from', !empty($banner) ? $banner->present()->availabilityFromDate('d/m/Y H:i:s') : null, [
            'class' => 'form-control mask-datetime datetime-picker',
            'data-rule' => 'empty',
            'data-start-date' => !empty($banner) ? $banner->present()->availabilityFromDate('d/m/Y H:i:s') : date('d/m/Y 00:00:00'),
            'placeholder' => '__/__/____'
        ]) !!}
    </div>
    <div class="field required form-group col-xs-5 col-sm-3 col-md-2">
        {!! Form::label('availability_to', 'Mostrar até', ['data-title' => 'Até esta data o banner será exibido', 'data-toggle' => 'tooltip']) !!}
        {!! Form::text('availability_to', !empty($banner) ? $banner->present()->availabilityToDate('d/m/Y H:i:s') : null, [
            'class' => 'form-control mask-datetime datetime-picker',
            'data-rule' => 'empty',
            'data-start-date' => !empty($banner) ? $banner->present()->availabilityToDate('d/m/Y H:i:s') : date('d/m/Y 23:59:59'),
            'placeholder' => '__/__/____'
        ]) !!}
    </div>
</div>

<hr>