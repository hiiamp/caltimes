@extends('user.master')

@section('content')
    <title>{{Auth::user()->name}}</title>
    @include('user.layouts.notification')

    @include('user.profile.layouts.header')

    @include('user.profile.layouts.contentworker')
    <script>
        $('.container1').css('height',$(window).height());
    </script>
@endsection