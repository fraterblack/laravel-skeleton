@extends('panel::cms.pages.base')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Cadastrar Nova Página</h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-default btn-xs btn-go-back"><i class="fa fa-arrow-left"></i> Voltar</a>
                    </div>
                    {!! Form::open(['route' => 'admin.pages.store', 'class' => 'has-validation ui form']) !!}

                    @include('panel::cms.pages._form')

                    <div class="form-group">
                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}

                        {!! Form::submit('Salvar e ir para Lista', ['class' => 'btn btn-secondary redirect-to-list']) !!}
                        {!! Form::checkbox('redirect_to_list', 'true', false, [ 'class' => 'hidden redirect-to-list-checkbox' ]) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection