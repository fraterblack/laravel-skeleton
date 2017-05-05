@extends('panel::base')

@section('contentWrapper')

    @include('panel::general.banners._partial.header')

    <section class="content">
        @include('panel::_partial.messages')
        @yield('content')
    </section>

@endsection

@push('foot_extend')
    <script src="{{ elixir('js/panel/banner.js') }}"></script>
@endpush