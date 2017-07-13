<div class="ui error small message"></div>
<div class="row">
    <div class="field required form-group col-md-6">
        {!! Form::label('name', 'Nome') !!}
        {!! Form::text('name', null, [ 'class' => 'form-control', 'data-rule' => 'empty' ]) !!}
    </div>
</div>
<div class="row">
    <div class="field required form-group col-md-6">
        {!! Form::label('email', 'E-mail') !!}
        {!! Form::text('email', null, [ 'class' => 'form-control', 'data-rule' => 'empty||email' ]) !!}
    </div>
</div>

<div class="row">
    <div class="field form-group col-xs-12">
        <label>
            {!! Form::checkbox('redefine_password', true, null, [ 'class' => 'custom-checkbox', 'data-toggle' => '.optional-inputs' ]) !!} Redefinir a senha
        </label>
    </div>
</div>

<div class="optional-inputs hidden">
    <div class="row">
        <div class="field required form-group col-md-3">
            {!! Form::label('password', 'Senha') !!}
            {!! Form::password('password', [ 'class' => 'form-control', 'data-rule-optional' => 'true', 'data-rule' => 'minLength[6]' ]) !!}
        </div>
        <div class="field required form-group col-md-3">
            {!! Form::label('password_confirmation', 'Confirme a Senha') !!}
            {!! Form::password('password_confirmation', [ 'class' => 'form-control', 'data-rule' => 'match[password]', 'data-rule-prompt' => '||Senha e confirmação não combinam' ]) !!}
        </div>
    </div>
</div>