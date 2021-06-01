@extends('layouts.master')
@section('title', 'Fırsat Raporları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')



@endsection

@section('page-styles')
    @include('pages.report.reports.opportunity.components.style')
@stop

@section('page-script')
    @include('pages.report.reports.opportunity.components.script')
@stop
