@extends('panel::cms.banners.base')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Banners</h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Cadastrar Banner</a>
                    </div>

                    @include('panel::_partial.manageListOfRecords')
                    <table class="table table-bordered table-striped data-table"  data-highlight-text="{{ Request::get('search') }}">
                        <thead>
                            <tr>
                                <th data-column="id">Id</th>
                                <th data-column="name">Nome</th>
                                <th data-column="type">Tipo</th>
                                <th data-column="type">Localização</th>
                                <th data-column="availability_from">De</th>
                                <th data-column="availability_to">Até</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $banner)
                            <tr data-item-id="{{ $banner->id }}" class="{{ ($banner->active) ? '' : 'danger' }}">
                                <td>{{ $banner->id }}</td>
                                <td>{{ $banner->name }}</td>
                                <td>{{ $banner->present()->typeName() }}</td>
                                <td>{{ $banner->place->name }}</td>
                                <td{!! $banner->availability_from > date('Y-m-d H:i:s') ? ' class="text-info"' : '' !!}>{{ $banner->present()->availabilityFromDate() }}</td>
                                <td{!! $banner->availability_to < date('Y-m-d H:i:s') ? ' class="text-danger"' : '' !!}>{{ $banner->present()->availabilityToDate() }}</td>
                                <td class="text-center">
                                    @include('panel::_components.toggleActivationButtons', ['active' => $banner->active, 'deactivate_route' => route('admin.banners.deactivate', $banner->id), 'activate_route' => route('admin.banners.activate', $banner->id)])
                                    @include('panel::_components.editButton', ['route' => route('admin.banners.edit', $banner->id)])
                                    @include('panel::_components.deleteButton', ['route' => route('admin.banners.delete', $banner->id)])
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