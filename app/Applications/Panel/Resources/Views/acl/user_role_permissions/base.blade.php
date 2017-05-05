@extends('panel::base')

@section('contentWrapper')

    @include('panel::user_role_permissions._partial.header')

    <section class="content">
        @include('panel::_partial.messages')
        @yield('content')
    </section>

@endsection