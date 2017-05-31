@extends('panel::base')

@section('contentWrapper')

    @include('panel::acl.my_account._partial.header')

    <section class="content">
        @include('panel::_partial.messages')
        @yield('content')
    </section>

@endsection