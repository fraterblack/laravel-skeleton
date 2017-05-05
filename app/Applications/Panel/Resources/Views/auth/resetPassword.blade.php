@extends('panel::baseAuth')

@section('contentWrapper')
    @include('panel::_partial.messages')

    <div class="login-box-body">
        <p class="login-box-msg"><img src="{{ config('app.admin.contractor.logo') }}" alt="{{ config('app.admin.contractor.name') }}"></p>

        {!! Form::open([ 'route' => 'admin.auth.postResetPassword', 'class' => 'has-validation ui form errors-inline art-auth-form' ]) !!}

        {!! Form::hidden('token', $token, ['class' => 'form-control']) !!}
        <fieldset>
            <p>Use o formulário abaixo para criar uma nova senha.</p>
            <div class="form-group has-feedback field required">
                {!! Form::email('email', null, [ 'class' => 'form-control', 'id' => 'l_email', 'placeholder' => 'E-mail' , 'data-rule' => 'empty' ]) !!}
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback field required">
                {!! Form::password('password', [ 'class' => 'form-control', 'id' => 'l_password', 'placeholder' => 'Senha', 'data-rule' => 'empty']) !!}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback field required">
                {!! Form::password('password_confirmation', [ 'class' => 'form-control', 'id' => 'l_password_confirmation', 'placeholder' => 'Repita a Senha', 'data-rule' => 'empty||match[password]', 'data-rule-prompt' => '||Senha e confirmação não combinam']) !!}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <a href="{{ route('admin.auth.getLogin') }}">Voltar para login</a>
                </div>
                <div class="col-xs-6">
                    {!! Form::submit('Recuperar senha', ['class' => 'btn btn-primary btn-block btn-flat']) !!}
                </div>
            </div>
        </fieldset>
        {!! Form::close() !!}
    </div>
@endsection