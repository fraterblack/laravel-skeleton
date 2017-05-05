@extends('panel::general.contacts.base')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Detalhes do Contato</h3>
                </div>
                <div class="box-body">
                    <div class="box-actions">
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-default btn-xs btn-go-back"><i class="fa fa-arrow-left"></i> Voltar</a>
                    </div>

                    <table class="table">
                        <tbody>
                        @foreach($contact->present()->dataToShow() as $attribute)
                            <tr>
                                <td style="width: 150px"><strong>{{ $attribute->name }}:</strong></td>
                                <td>{!! $attribute->value !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection