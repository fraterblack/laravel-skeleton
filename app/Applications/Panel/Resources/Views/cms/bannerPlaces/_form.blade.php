<div class="ui error small message"></div>
<div class="row">
    <div class="field required form-group col-md-6">
        {!! Form::label('name', 'Nome do Local') !!}
        {!! Form::text('name', null, [ 'class' => 'form-control', 'data-rule' => 'empty' ]) !!}
    </div>
</div>

<div class="row">
    <div class="field required form-group col-xs-12 col-lg-6">
        {!! Form::label('description', 'Descrição') !!}
        {!! Form::textarea('description', null, [
            'class' => 'form-control',
            'data-rule' => 'empty',
            'rows' => '2'
        ]) !!}
    </div>
</div>

<div class="box box-widget form-group">
    <div class="field required box-header">
        {!! Form::label('image_map', 'Mapa do Banner no Site') !!}
    </div>
    @if(!empty($place) && $place->present()->getUrlImage('thumb'))
        <div class="box-body">
            <a data-rel="lightbox" href="{{ $place->present()->getUrlImage('original') }}">
                <img src="{{ $place->present()->getUrlImage('thumb') }}" alt=""/>
            </a>
        </div>
    @endif
    <div class="box-footer">
        {!! Form::file('image_map') !!}
    </div>
</div>

<div class="row">
    <div class="field form-group col-sm-6 col-md-3 col-lg-2">
        {!! Form::label('background_color', 'Cor de Fundo') !!}
        <div class="input-group colorpicker-input">
            {!! Form::text('background_color', !empty($place) ? null : '#F5F5F5', [ 'class' => 'form-control mask-hexacolor', 'max-length' => '7' ]) !!}
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="field form-group col-xs-6 col-sm-4 col-md-3 col-lg-2">
        {!! Form::label('width', 'Largura') !!}
        {!! Form::text('width', (!empty($place) && $place->width > 0 ? null : ''), ['class' => 'form-control mask-number']) !!}
    </div>
    <div class="field form-group col-xs-6 col-sm-4 col-md-3 col-lg-2">
        {!! Form::label('height', 'Altura') !!}
        {!! Form::text('height', (!empty($place) && $place->height > 0 ? null : ''), ['class' => 'form-control mask-number']) !!}
    </div>
    <div class="field form-group col-xs-12 col-sm-4 col-md-6 col-lg-8">
        <p class="help-block">
            <strong>Importante:</strong><br>
            Ao menos uma das dimensões deve ser informada. Informe uma das medidas para redimensionamento adaptivo. Se ambas as dimensões forem preenchidas, o banner terá exatamente a medida informada.
        </p>
    </div>
</div>
<div class="row">
    <div class="field required form-group col-xs-6 col-sm-4 col-md-3 col-lg-2">
        {!! Form::label('display', 'Mostrar', ['data-title' => 'Quantos banners serão exibidos. Se for do tipo carousel, esse será o número de banners por página.', 'data-toggle' => 'tooltip']) !!}
        {!! Form::text('display', null, [ 'class' => 'form-control mask-number', 'data-rule' => 'empty' ]) !!}
    </div>
    <div class="field required form-group col-xs-6 col-sm-4 col-md-3 col-lg-2">
        {!! Form::label('limit', 'Limite', ['data-title' => 'Se aplica somente em banners do tipo carousel.', 'data-toggle' => 'tooltip']) !!}
        {!! Form::text('limit', null, [ 'class' => 'form-control mask-number', 'data-rule' => 'empty' ]) !!}
    </div>
    <div class="field required form-group col-xs-6 col-sm-4 col-md-3 col-lg-2">
        {!! Form::label('rand', 'Randômico', ['data-title' => 'Banners passarão a ser exibidos randomicamente.', 'data-toggle' => 'tooltip']) !!}
        {!! Form::select('rand', [1 => 'Sim', 0 => 'Não'], null, ['data-rule' => 'empty', 'class' => 'form-control']) !!}
    </div>
</div>

<div class="row">
    <div class="field required col-xs-12">
        {!! Form::label('accepted_types', 'Tipos de Banner Permitidos') !!}
    </div>
    <div class="form-group col-xs-12">
    @foreach($types as $code => $name)
        <label>
            {!! Form::checkbox('accepted_types[]', $code, (!empty($place) && in_array($code, $place->accepted_types)) ? true : null, [ 'class' => 'custom-checkbox' ]) !!} {{ $name }}
        </label>
    @endforeach
    </div>
</div>