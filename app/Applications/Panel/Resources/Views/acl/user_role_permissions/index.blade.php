@extends('panel::user_role_permissions.base')

@section('content')

    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Recursos</h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                        <a href="{{ route('panel::user_role_permissions.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Cadastrar Novo Recurso</a>
                    </div>

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th data-column="id">Id</th>
                            <th>Código</th>
                            <th>Nome</th>
                            <th class="text-center">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->readable_name }}</td>
                                <td class="text-center">
                                    @if($permission->name != config('defender.superuser_role') && $permission->name != 'admin')
                                        <a class="btn btn-danger btn-xs" href="{{ route('panel::user_role_permissions.delete', $permission->id) }}" data-confirm="true" data-confirm-danger="true"><i class="fa fa-trash"></i></a>
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