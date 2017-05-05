<div class="ui error small message"></div>
<div class="row">
    <div class="field required form-group col-md-6">
        {!! Form::label('name', 'Nome') !!}
        {!! Form::text('name', null, [ 'class' => 'form-control', 'data-rule' => 'empty' ]) !!}
    </div>
</div>
<div class="row">
    <div class="field required form-group col-md-6">
        {!! Form::label('username', 'Username') !!}
        {!! Form::text('username', null, [ 'class' => 'form-control', 'data-rule' => 'empty' ]) !!}
    </div>
</div>
<div class="row">
    <div class="field required form-group col-md-6">
        {!! Form::label('email', 'E-mail') !!}
        {!! Form::text('email', null, [ 'class' => 'form-control', 'data-rule' => 'empty||email' ]) !!}
    </div>
</div>

@if(empty($user))
    <div class="row">
        <div class="field required form-group col-md-3">
            {!! Form::label('password', 'Senha') !!}
            {!! Form::text('password', '', [ 'class' => 'form-control', 'data-rule' => 'empty||minLength[6]' ]) !!}
        </div>
        <div class="field required form-group col-md-3">
            {!! Form::label('password_confirmation', 'Confirme a Senha') !!}
            {!! Form::text('password_confirmation', '', [ 'class' => 'form-control', 'data-rule' => 'empty||match[password]', 'data-rule-prompt' => '||Senha e confirmação não combinam' ]) !!}
        </div>
    </div>
@else
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
                {!! Form::text('password', '', [ 'class' => 'form-control', 'data-rule-optional' => 'true', 'data-rule' => 'minLength[6]' ]) !!}
            </div>
            <div class="field required form-group col-md-3">
                {!! Form::label('password_confirmation', 'Confirme a Senha') !!}
                {!! Form::text('password_confirmation', '', [ 'class' => 'form-control', 'data-rule' => 'match[password]', 'data-rule-prompt' => '||Senha e confirmação não combinam' ]) !!}
            </div>
        </div>
    </div>
@endif

<div class="row">
    <div class="field required form-group col-md-6">
        {!! Form::label('roles', 'Função do Usuário') !!}
        <select id="roles" name="roles[]"
                class="form-control defaultSelect2"
                multiple="multiple"
                data-placeholder="Selecione a função do usuário">
            @foreach($roles as $id=>$name)
                <?php
                $selected = (!empty($user) && $user->roles->where('name', $name)->count()) ? ' selected' : '';
                ?>
                <option value="{{ $id }}"{{ $selected }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>
</div>