@extends('layouts.master')
@section('title', 'Rapor')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.dashboard.layouts.subheader')

    <div class="row mt-15">

    </div>

@endsection

@section('page-styles')
    @include('pages.dashboard.report.components.style')
@stop

@section('page-script')
    @include('pages.dashboard.report.components.script')
@stop
