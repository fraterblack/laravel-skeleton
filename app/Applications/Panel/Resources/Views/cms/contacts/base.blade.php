@extends('panel::base')

@section('contentWrapper')

    @include('panel::cms.contacts._partial.header')

    <section class="content">
        @include('panel::_partial.messages')
        @yield('content')
    </section>

@endsection