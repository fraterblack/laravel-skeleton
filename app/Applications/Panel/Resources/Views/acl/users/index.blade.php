@extends('panel::general.users.base')

@section('content')

    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Usuários</h3>
                </div>
                <div class="box-body">

                    @include('panel::_partial.manageListOfRecords')

                    <table class="table table-bordered table-striped data-table"  data-highlight-text="{{ Request::get('search') }}">
                        <thead>
                        <tr>
                            <th data-column="id">Id</th>
                            <th data-column="username">Username</th>
                            <th data-column="name">Nome</th>
                            <th data-column="created_at">Cadastro</th>
                            <th class="text-center">Funções</th>
                            <th class="text-center">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->present()->creationDate('d/m/y à\s H:i \h\s') }}</td>
                                <td class="text-center">
                                    @foreach($user->roles as $role)
                                        @if($role->name == config('defender.superuser_role'))
                                            {{ $role->name }}
                                        @else
                                            <a href="{{ route('panel::user_roles.editPermissions', $role->id) }}">{{ $role->name }}</a>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    {{--@if($user->id != 1)
                                        <a class="btn btn-primary btn-xs" href="{{ route('admin.acl.users.edit', $user->id) }}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-danger btn-xs" href="{{ route('admin.acl.users.delete', $user->id) }}" data-confirm="true" data-confirm-danger="true"><i class="fa fa-trash"></i></a>
                                    @endif--}}
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