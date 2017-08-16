@extends('panel::baseAuth')

@section('contentWrapper')
    @include('panel::_partial.messages')

    <div class="login-box-body">
        <p class="login-box-msg"><img src="{{ config('admin-panel.contractor.logo') }}" alt="{{ config('admin-panel.contractor.name') }}"></p>
        @include('panel::auth._partial.loginForm')
    </div>
@endsection