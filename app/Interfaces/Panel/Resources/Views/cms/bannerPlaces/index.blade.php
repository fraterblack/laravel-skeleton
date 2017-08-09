@extends('panel::cms.bannerPlaces.base')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Locais de Banners</h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                        <a href="{{ route('admin.bannerPlaces.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Cadastrar Local</a>
                    </div>

                    @include('panel::_partial.indexFilter.inputs')

                    <table class="table table-bordered table-striped data-table"  data-highlight-text="{{ Request::get('search') }}">
                        <thead>
                            <tr>
                                <th data-column="id">Id</th>
                                <th data-column="name">Nome</th>
                                <th data-column="width">Tamanho</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $place)
                            <tr data-item-id="{{ $place->id }}" class="{{ ($place->active) ? '' : 'danger' }}">
                                <td>{{ $place->id }}</td>
                                <td>{{ $place->name }}</td>
                                <td>{{ ($place->width > 0) ? $place->width : '---' }}x{{ ($place->height > 0) ? $place->height : '---' }} pixels</td>
                                <td class="text-center">
                                    @include('panel::_components.toggleActivationButtons', ['active' => $place->active, 'deactivate_route' => route('admin.bannerPlaces.deactivate', $place->id), 'activate_route' => route('admin.bannerPlaces.activate', $place->id)])
                                    @include('panel::_components.editButton', ['route' => route('admin.bannerPlaces.edit', $place->id)])
                                    @include('panel::_components.deleteButton', ['route' => route('admin.bannerPlaces.delete', $place->id)])
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