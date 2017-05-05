@extends('panel::general.contactRecipients.base')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Editar Destinatário de Contato/h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                        <a href="{{ route('admin.contactRecipients.index') }}" class="btn btn-default btn-xs btn-go-back"><i class="fa fa-arrow-left"></i> Voltar</a>
                    </div>

                    {!! Form::model($recipient, ['route' => ['admin.contactRecipients.update', $recipient->id], 'class' => 'has-validation ui form', 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}

                    {!! Form::hidden('last_url', URL::previous()) !!}

                    @include('panel::general.contactRecipients._form')

                    <div class="form-group">
                        {!! Form::submit('Salvar Alterações', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection