@extends('panel::general.utils.base')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Controle de Cache</h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                    </div>

                    <ul>
                        <li><a href="{{ route('admin.utils.cacheControl', ['command' => 'route_cache']) }}">Cache de Rotas</a></li>
                        <li><a href="{{ route('admin.utils.cacheControl', ['command' => 'route_clear']) }}">Limpar Cache de Rotas</a></li>
                    </ul>
                    <ul>
                        <li><a href="{{ route('admin.utils.cacheControl', ['command' => 'config_cache']) }}" class="text-danger" data-confirm="true">Cache de Configurações</a></li>
                        <li><a href="{{ route('admin.utils.cacheControl', ['command' => 'config_clear']) }}">Limpar Cache de Configurações</a></li>
                    </ul>
                    <ul>
                        <li><a href="{{ route('admin.utils.cacheControl', ['command' => 'optimize']) }}">Otimizar Class Loader</a></li>
                        <li><a href="{{ route('admin.utils.cacheControl', ['command' => 'clear_compiled']) }}">Limpar Compilado</a></li>
                    </ul>
                    <ul>
                        <li><a href="{{ route('admin.utils.cacheControl', ['command' => 'cache_clear']) }}">Limpar Cache de Queries</a></li>
                    </ul>
                    <ul>
                        <li><a href="{{ route('admin.utils.cacheControl', ['command' => 'view_clear']) }}">Limpar Cache de Views</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection