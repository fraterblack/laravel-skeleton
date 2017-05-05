{!! Form::open([ 'route' => 'admin.auth.postForgotPassword', 'class' => 'has-validation ui form errors-inline art-auth-form' ]) !!}
<fieldset>
    <p>Informe seu e-mail para recuperar a senha.</p>
    @if(!empty($redirect_to))
        {!! Form::hidden('redirect_to', $redirect_to) !!}
    @endif
    <div class="form-group has-feedback field required">
        {!! Form::email('email', null, [ 'class' => 'form-control', 'id' => 'l_email', 'placeholder' => 'E-mail' , 'data-rule' => 'empty' ]) !!}
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
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