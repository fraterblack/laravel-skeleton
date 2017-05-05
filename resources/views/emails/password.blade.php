@extends('emails.base')

@section('email.content')

    @include('emails._partial.commonContent')

    @include('emails._partial.signature')

@endsection
