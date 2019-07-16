@extends('user.master')

@section('content')
    <title>{{Auth::user()->name}}</title>
    @include('user.layouts.notification')

    @include('user.profile.layouts.header')

    @include('user.profile.layouts.content')

@endsection
