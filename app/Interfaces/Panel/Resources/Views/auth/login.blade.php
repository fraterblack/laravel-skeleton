@extends('panel::baseAuth')

@section('contentWrapper')
    @include('panel::_partial.messages')

    <div class="login-box-body">
        <p class="login-box-msg"><img src="{{ config('app.admin.contractor.logo') }}" alt="{{ config('app.admin.contractor.name') }}"></p>
        @include('panel::auth._partial.loginForm')
    </div>
@endsection