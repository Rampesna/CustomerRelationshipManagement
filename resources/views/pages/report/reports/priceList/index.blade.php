@extends('layouts.master')
@section('title', 'Fiyat Listesi Raporları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')



@endsection

@section('page-styles')
    @include('pages.report.reports.priceList.components.style')
@stop

@section('page-script')
    @include('pages.report.reports.priceList.components.script')
@stop
