@extends('layouts.master')
@section('title', 'Fırsat Detayları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.opportunity.show.layouts.subheader')

@endsection

@section('page-styles')
    @include('pages.opportunity.show.offer.components.style')
@stop

@section('page-script')
    @include('pages.opportunity.show.offer.components.script')
@stop
