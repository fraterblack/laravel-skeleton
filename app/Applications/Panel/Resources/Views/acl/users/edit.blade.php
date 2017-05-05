@extends('panel::acl.users.base')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Editar Usuário</h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                        <a href="{{ route('admin.acl.users.index') }}" class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i> Voltar à Lista</a>
                    </div>

                    {!! Form::model($user, ['route' => ['admin.acl.users.update', $user->id], 'class' => 'has-validation ui form', 'method' => 'put' ]) !!}

                    {!! Form::hidden('last_url', URL::previous()) !!}

                    @include('panel::acl.users._form')

                    <div class="form-group">
                        {!! Form::submit('Salvar Alterações', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection