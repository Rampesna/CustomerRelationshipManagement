@extends('mobile.layouts.master')
@section('title', 'Anasayfa')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    Mobile Dashboard

@endsection

@section('page-styles')
    @include('mobile.dashboard.components.style')
@stop

@section('page-script')
    @include('mobile.dashboard.components.script')
@stop
