@extends('panel::acl.my_account.base')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Alterar Informações de Acesso</h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                    </div>

                    {!! Form::model($user, ['route' => ['admin.myAccount.update', $user->id], 'class' => 'has-validation ui form', 'method' => 'put' ]) !!}

                    {!! Form::hidden('last_url', URL::previous()) !!}

                    @include('panel::acl.my_account._form')

                    <div class="form-group">
                        {!! Form::submit('Salvar Alterações', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection