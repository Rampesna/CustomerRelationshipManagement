@extends('layouts.master')
@section('title', 'Anasayfa')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')



@endsection

@section('page-styles')
    @include('pages.dashboard.components.style')
@stop

@section('page-script')
    @include('pages.dashboard.components.script')
@stop
