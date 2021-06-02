@extends('layouts.master')
@section('title', 'Sistem Ayarları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')



@endsection

@section('page-styles')
    @include('pages.setting.settings.system.components.style')
@stop

@section('page-script')
    @include('pages.setting.settings.system.components.script')
@stop
