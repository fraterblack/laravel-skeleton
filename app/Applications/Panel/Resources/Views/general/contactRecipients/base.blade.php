@extends('panel::base')

@section('contentWrapper')

    @include('panel::general.contactRecipients._partial.header')

    <section class="content">
        @include('panel::_partial.messages')
        @yield('content')
    </section>

@endsection