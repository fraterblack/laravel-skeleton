@extends('panel::general.banners.base')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Editar Local de Banner</h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-default btn-xs btn-go-back"><i class="fa fa-arrow-left"></i> Voltar</a>
                    </div>

                    {!! Form::model($banner, ['route' => ['admin.banners.update', $banner->id], 'class' => 'has-validation ui form', 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}

                    {!! Form::hidden('last_url', URL::previous()) !!}

                    @include('panel::general.banners._form')

                    <div class="form-group">
                        {!! Form::submit('Salvar Alterações', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection