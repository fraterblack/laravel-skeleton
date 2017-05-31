@extends('emails.base')

@section('email.content')

    Olá {{ $user->name }}!<br>
    você foi cadastrado como administrador do site.<br><br>
    Segue seus dados para acesso ao painel administrativo:<br>
    <div>
        URL do Painel: <a href="{{ $panel_url }}">{{ $panel_url }}</a><br>
        E-mail: {{ $user->email }}<br>
        Senha: <strong>{{ $password }}</strong> <em>(Recomendamos fortemente que você altere essa senha logo no primeiro acesso)</em>
    </div>
    <br>
    Como administrador, você tem as seguintes permissões:
    <table style="width: 100%; margin: 10px 0 30px auto; padding: 10px; background-color: #f0f0f0; text-align: center;" align="center" width="100%" cellpadding="0" cellspacing="0">
        <tbody>
        @foreach($user->getAllPermissions() as $permission)
            <tr>
                <td style="width: 150px; font-family: Arial; font-size: 13px; text-align: left; vertical-align: top;">{{ $permission->readable_name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

