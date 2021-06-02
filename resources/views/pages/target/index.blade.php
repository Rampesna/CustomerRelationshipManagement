@extends('layouts.master')
@section('title', 'Hedefler')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')



@endsection

@section('page-styles')
    @include('pages.target.components.style')
@stop

@section('page-script')
    @include('pages.target.components.script')
@stop
