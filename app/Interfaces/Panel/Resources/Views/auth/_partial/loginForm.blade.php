{!! Form::open([ 'route' => 'admin.auth.postLogin', 'class' => 'has-validation ui form errors-inline art-auth-form' ]) !!}
    <fieldset>
        @if(!empty($redirect_to))
            {!! Form::hidden('redirect_to', $redirect_to) !!}
        @endif
        <div class="form-group has-feedback field required">
            {!! Form::email('email', null, [ 'class' => 'form-control', 'id' => 'l_email', 'placeholder' => 'E-mail' , 'data-rule' => 'empty' ]) !!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback field required">
            {!! Form::password('password', [ 'class' => 'form-control', 'id' => 'l_password', 'placeholder' => 'Senha', 'data-rule' => 'empty']) !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="row">
            <div class="col-xs-8">
                <a href="{{ route('admin.auth.getForgotPassword') }}">Esqueci minha senha</a>
            </div>
            <div class="col-xs-4">
                {!! Form::submit('Entrar', ['class' => 'btn btn-primary btn-block btn-flat']) !!}
            </div>
        </div>
    </fieldset>
{!! Form::close() !!}