@extends('site::base')

@section('content')

    <section>
        <p>Página inicial da aplicação Site</p>
        <p>Para acessar o painel administrativo, acesse: <a href="{{ route('admin.initial') }}">{{ env('ADMIN_URL') }}</a></p>
    </section>

@endsection