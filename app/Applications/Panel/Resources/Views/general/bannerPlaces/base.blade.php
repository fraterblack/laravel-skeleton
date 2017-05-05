@extends('panel::base')

@section('contentWrapper')

    @include('panel::general.bannerPlaces._partial.header')

    <section class="content">
        @include('panel::_partial.messages')
        @yield('content')
    </section>

@endsection