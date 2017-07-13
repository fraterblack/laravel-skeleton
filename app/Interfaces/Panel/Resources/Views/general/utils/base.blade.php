@extends('panel::base')

@section('contentWrapper')

    @include('panel::general.utils._partial.header')

    <section class="content">
        @include('panel::_partial.messages')
        @yield('content')
    </section>

@endsection