@extends('user.master')

@section('content')
    @include('user.layouts.notification')

    @include('user.notification.layouts.header')

    @include('user.notification.layouts.content')
@endsection
