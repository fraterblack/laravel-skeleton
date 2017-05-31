@extends('panel::acl.user_roles.base')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Gerenciar Permissões da Função</h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                        <a href="{{ route('admin.user_roles.index') }}" class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i> Voltar à Lista</a>
                    </div>

                    <div class="box-header with-border">
                        <h4 class="box-title">Usuários com a função {{ $role->name }} podem:</h4>
                    </div>
                    <div class="box-body">

                        {!! Form::model($role, ['route' => ['admin.user_roles.updatePermissions', $role->id], 'class' => 'has-validation ui form', 'method' => 'put' ]) !!}

                        {!! Form::hidden('last_url', URL::previous()) !!}
                        <?php
                            $permissions = $permissions->sortBy('name');
                            $selectedPermissions = $role->permissions->pluck('id')->toArray();
                        ?>
                        @foreach($permissions as $permission)
                            <div class="row">
                                <div class="field form-group col-xs-12">
                                    <label class="{{ ($permission->name == config('defender.superuser_role')) ? 'text-primary' : '' }}">
                                        <?php
                                            $elementAttributes = [ 'class' => 'custom-checkbox', 'data-toggle' => '.optional-inputs' ];
                                            if ($permission->name == 'admin') {
                                                $elementAttributes['disabled'] = 'disabled';
                                            }
                                        ?>
                                        {!! Form::checkbox('selected_permission[]', $permission->id, (in_array($permission->id, $selectedPermissions) || $permission->name == 'admin') ? true : false, $elementAttributes) !!} {{ $permission->readable_name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach

                        <div class="form-group">
                            {!! Form::submit('Salvar Alterações', ['class' => 'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection