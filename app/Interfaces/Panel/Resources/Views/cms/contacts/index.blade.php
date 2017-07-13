@extends('panel::cms.contacts.base')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Contatos</h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                    </div>

                    @include('panel::_partial.manageListOfRecords')
                    <table class="table table-bordered table-striped data-table"  data-highlight-text="{{ Request::get('search') }}">
                        <thead>
                            <tr>
                                <th data-column="id">Id</th>
                                <th data-column="name">Nome</th>
                                <th data-column="subject">Assunto</th>
                                <th data-column="created_at">Em</th>
                                <th data-column="recipient_name">Para</th>
                                <th data-column="sent">Enviado</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $contact)
                            <tr data-item-id="{{ $contact->id }}" class="{{ ($contact->replied) ? ' text-info' : '' }}">
                                <td>{{ $contact->id }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->present()->availableSubject() }}</td>
                                <td>{{ $contact->present()->creationDate('d/m/Y H:i \h\s') }}</td>
                                <td>{{ $contact->recipient->name }}</td>
                                <td>@include('panel::_components.checked', ['checked' => $contact->sent])</td>
                                <td class="text-center">
                                    @include('panel::_components.showButton', ['route' => route('admin.contacts.show', $contact->id)])
                                    @if ($contact->replied)
                                        <a href="{{ route('admin.contacts.unmarkAsReplied', $contact->id) }}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Desmarcar">
                                            <i class="fa fa-times text-danger"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('admin.contacts.markAsReplied', $contact->id) }}" class="btn btn-default btn-xs" data-toggle="tooltip" title="Marcar">
                                            <i class="fa fa-reply text-success"></i>
                                        </a>
                                    @endif
                                    @include('panel::_components.deleteButton', ['route' => route('admin.contacts.delete', $contact->id)])
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