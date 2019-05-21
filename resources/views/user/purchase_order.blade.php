@extends('layout.user')
@section('head')
    @include('template.head_user_template')
@endsection
@section('content')
    @include('user.header')
    @include('user.sidebar')
@endsection
@section('script')
    @include('template.script_user_template')
@endsection