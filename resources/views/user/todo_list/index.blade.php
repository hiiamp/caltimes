@extends('user.master')

@section('content')
    <title>{{$list->name}}</title>
    @include('user.layouts.notification')

    @include('user.todo_list.layouts.header')

    @include('user.todo_list.layouts.content')
@endsection
