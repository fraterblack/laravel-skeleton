@extends('panel::base')

@section('contentWrapper')

    @include('panel::cms.contactRecipients._partial.header')

    <section class="content">
        @include('panel::_partial.messages')
        @yield('content')
    </section>

@endsection