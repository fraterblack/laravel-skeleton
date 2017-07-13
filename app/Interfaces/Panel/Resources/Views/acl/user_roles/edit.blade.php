@extends('panel::acl.user_roles.base')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Editar Função</h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                        <a href="{{ route('admin.user_roles.index') }}" class="btn btn-default btn-xs btn-go-back"><i class="fa fa-arrow-left"></i> Voltar à Lista</a>
                    </div>

                    {!! Form::model($role, ['route' => ['admin.user_roles.update', $role->id], 'class' => 'has-validation ui form', 'method' => 'put' ]) !!}

                    {!! Form::hidden('last_url', URL::previous()) !!}

                    @include('panel::acl.user_roles._form')

                    <div class="form-group">
                        {!! Form::submit('Salvar Alterações', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection