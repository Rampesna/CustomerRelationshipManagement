@extends('layouts.master')
@section('title', 'Yedekleme Ayarları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')



@endsection

@section('page-styles')
    @include('pages.setting.settings.backup.components.style')
@stop

@section('page-script')
    @include('pages.setting.settings.backup.components.script')
@stop
