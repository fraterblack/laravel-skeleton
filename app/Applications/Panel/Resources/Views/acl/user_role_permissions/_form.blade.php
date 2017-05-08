<div class="ui error small message"></div>
<div class="alert alert-warning">
    Novoas atribuições só funcionarão após intervenção no código pelo programador.
</div>
<div class="row">
    <div class="field required form-group col-md-4">
        {!! Form::label('name', 'Código') !!}
        {!! Form::text('name', null, [ 'class' => 'form-control', 'data-rule' => 'empty' ]) !!}
        <div class="help-block">Não usar espaços</div>
    </div>
</div>
<div class="row">
    <div class="field required form-group col-md-6">
        {!! Form::label('readable_name', 'Nome') !!}
        {!! Form::text('readable_name', null, [ 'class' => 'form-control', 'data-rule' => 'empty' ]) !!}
    </div>
</div>


