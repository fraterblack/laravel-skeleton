<div class="ui error small message"></div>
<div class="row">
    <div class="field required form-group col-md-6">
        {!! Form::label('name', 'Nome do Destinatário') !!}
        {!! Form::text('name', null, [ 'class' => 'form-control', 'data-rule' => 'empty' ]) !!}
    </div>
</div>

<div class="row">
    <div class="field required form-group col-md-6">
        {!! Form::label('email', 'E-mail') !!}
        {!! Form::text('email', null, [ 'class' => 'form-control', 'data-rule' => 'empty' ]) !!}
        <p class="help-block">Use vírgulas para cadastrar mais de um e-mail.</p>
    </div>
</div>