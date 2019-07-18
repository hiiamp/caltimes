@extends('user.master')

@section('content')
    <title>{{Auth::user()->name}}</title>
    @include('user.layouts.notification')

    @include('user.profile.layouts.header')

    @include('user.profile.layouts.content')

    <script>
        $(document).ready(function () {
            $('#search').hide();
            $('#searchTask').hide();
        });
    </script>
@endsection
