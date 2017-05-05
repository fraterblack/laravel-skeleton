@extends('emails.base')

@section('email.content')

    Olá {{ $contact->recipient->name }}!<br>
    O sr(a) {{ $contact->name }} entrou em contato através do site.<br><br>
    Segue dados enviados através do formulário:<br><br>
    <table style="width: 100%; margin: 30px auto; padding: 0; text-align: center;" align="center" width="100%" cellpadding="0" cellspacing="0">
        <tbody>
        @foreach($contact->present()->dataToShow() as $attribute)
            @if($attribute->name == 'Enviado')
                @continue
            @endif
            <tr>
                <td style="width: 150px; font-family: Arial; font-size: 13px; text-align: left; vertical-align: top;"><strong>{{ $attribute->name }}:</strong></td>
                <td style="font-family: Arial;  font-size: 13px; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px;{{ ($attribute->name == 'Mensagem') ? ' background-color: #fffeef; border: 1px solid #f5f5f5; padding-left: 10px; padding-right: 10px;' : '' }}">{!! $attribute->value !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

