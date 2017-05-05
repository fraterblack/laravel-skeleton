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
                                <th data-column="name">Nome</th>
                                <th data-column="active" class="text-center">Ativo</th>
                                <th data-column="created_at">Cadastrado em</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td class="text-center">@include('panel::_components.checked', ['checked' => $user->active])</td>
                                <td>{{ $user->present()->creationDate('d/m/y à\s H:i \h\s') }}</td>
                                <td class="text-center">
                                    @include('panel::_components.deleteButton', ['route' => route('admin.users.delete', $user->id)])
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