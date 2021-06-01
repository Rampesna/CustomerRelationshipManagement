@extends('layouts.master')
@section('title', 'Teklif Raporları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')



@endsection

@section('page-styles')
    @include('pages.report.reports.offer.components.style')
@stop

@section('page-script')
    @include('pages.report.reports.offer.components.script')
@stop
