@extends('panel::acl.user_role_permissions.base')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Cadastrar Nova Permissão</h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                        <a href="{{ route('admin.user_role_permissions.index') }}" class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i> Voltar à Lista</a>
                    </div>
                    {!! Form::open(['route' => 'admin.user_role_permissions.store', 'class' => 'has-validation ui form']) !!}

                    @include('panel::acl.user_role_permissions._form')

                    <div class="row">
                        <div class="field form-group col-xs-12">
                            <label>Atribuir à:</label><br>
                        @foreach($user_roles as $role)
                            @if($role->id == 1)
                                @continue
                            @endif
                            <div class="form-group">
                                <label>
                                    {!! Form::checkbox('sync_permission_with[]', $role->id, null, [ 'class' => 'custom-checkbox' ]) !!} {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}

                        {!! Form::submit('Salvar e ir para Lista', ['class' => 'btn btn-secondary redirect-to-list']) !!}
                        {!! Form::checkbox('redirect_to_list', 'true', false, [ 'class' => 'hidden redirect-to-list-checkbox' ]) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection