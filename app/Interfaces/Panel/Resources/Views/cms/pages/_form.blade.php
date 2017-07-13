<div class="ui error small message"></div>
<div class="row">
    <div class="field required form-group col-md-6">
        {!! Form::label('title', 'Título') !!}
        {!! Form::text('title', null, [ 'class' => 'form-control', 'data-rule' => 'empty' ]) !!}
    </div>
</div>

<div class="row">
    <div class="field required form-group col-xs-12">
        {!! Form::label('text', 'Conteúdo da Página') !!}
        {!! Form::textarea('text', null, [
            'class' => 'form-control extended-editor',
            'data-content-css' => elixir('css/panel/editor.css'),
            'data-rule' => 'empty',
            'rows' => '5'
        ]) !!}
    </div>
</div>

<div class="row">
    <div class="field form-group col-md-6">
        {!! Form::label('slug', 'Slug Personalizado') !!}
        {!! Form::text('slug', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
