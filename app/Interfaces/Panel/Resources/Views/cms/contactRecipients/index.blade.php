@extends('panel::cms.contactRecipients.base')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Destinatários de Contato</h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                        <a href="{{ route('admin.contactRecipients.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Cadastrar Destinatário</a>
                    </div>

                    @include('panel::_partial.indexFilter.inputs')

                    <table class="table table-bordered table-striped data-table"  data-highlight-text="{{ Request::get('search') }}">
                        <thead>
                            <tr>
                                <th data-column="id">Id</th>
                                <th data-column="name">Nome</th>
                                <th data-column="width">E-mail</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $recipient)
                            <tr data-item-id="{{ $recipient->id }}" class="{{ ($recipient->active) ? '' : 'danger' }}">
                                <td>{{ $recipient->id }}</td>
                                <td>{{ $recipient->name }}</td>
                                <td>{{ $recipient->email }}</td>
                                <td class="text-center">
                                    @include('panel::_components.toggleActivationButtons', ['active' => $recipient->active, 'deactivate_route' => route('admin.contactRecipients.deactivate', $recipient->id), 'activate_route' => route('admin.contactRecipients.activate', $recipient->id)])
                                    @include('panel::_components.editButton', ['route' => route('admin.contactRecipients.edit', $recipient->id)])
                                    @include('panel::_components.deleteButton', ['route' => route('admin.contactRecipients.delete', $recipient->id)])
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