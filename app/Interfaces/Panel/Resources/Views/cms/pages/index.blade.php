@extends('panel::cms.pages.base')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Páginas</h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Cadastrar Página</a>
                    </div>

                    @include('panel::_partial.manageListOfRecords')

                    <table class="table table-bordered table-striped data-table"  data-highlight-text="{{ Request::get('search') }}">
                        <thead>
                            <tr>
                                <th data-column="id">Id</th>
                                <th data-column="title">Título</th>
                                <th data-column="slug">URL</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $page)
                            <tr data-item-id="{{ $page->id }}" class="{{ ($page->active) ? '' : 'danger' }}">
                                <td>{{ $page->id }}</td>
                                <td>{{ $page->title }}</td>
                                <td>{{--<a href="{{ route('pages.show', $page->slug) }}" target="_blank">{{ route('pages.show', $page->slug) }}</a>--}}</td>
                                <td class="text-center">
                                    @include('panel::_components.toggleActivationButtons', ['active' => $page->active, 'deactivate_route' => route('admin.pages.deactivate', $page->id), 'activate_route' => route('admin.pages.activate', $page->id)])
                                    @include('panel::_components.editButton', ['route' => route('admin.pages.edit', $page->id)])
                                    @include('panel::_components.deleteButton', [
                                        'route' => route('admin.pages.delete', $page->id),
                                        'disable' => ! $page->deletable(),
                                    ])
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