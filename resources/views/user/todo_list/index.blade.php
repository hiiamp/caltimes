@extends('user.master')

@section('content')
    <title>{{$list->name}}</title>

    @include('user.todo_list.layouts.header')

    @include('user.todo_list.layouts.content')
@endsection
