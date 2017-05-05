@extends('panel::base')

@section('contentWrapper')

    @include('panel::general.pages._partial.header')

    <section class="content">
        @include('panel::_partial.messages')
        @yield('content')
    </section>

@endsection