@extends('panel::acl.user_roles.base')

@section('content')

    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Funções</h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                        <a href="{{ route('admin.user_roles.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Cadastrar Nova Função</a>
                    </div>

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th data-column="id">Id</th>
                            <th>Nome</th>
                            <th>Atribuições da Função</th>
                            <th class="text-center">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @if($role->name != config('defender.superuser_role'))
                                        <a class="btn btn-default btn-xs" href="{{ route('admin.user_roles.editPermissions', $role->id) }}">Gerenciar Atribuições</a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($role->name != config('defender.superuser_role') && $role->name != config('defender.superuser_role') && $role->name != 'admin')
                                        <a class="btn btn-primary btn-xs" href="{{ route('admin.user_roles.edit', $role->id) }}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-danger btn-xs" href="{{ route('admin.user_roles.delete', $role->id) }}" data-confirm="true" data-confirm-danger="true"><i class="fa fa-trash"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @include('panel::_partial.recordsPagination')
                </div>
            </div>
        </div>
    </div>

@endsection