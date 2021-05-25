@extends('layouts.master')
@section('title', 'Fırsat Detayları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('mobile.opportunity.show.layouts.subheader')

    <div class="text-center pt-15">
        <div class="h4 text-dark-50">Bu Bölüm Henüz Yapım Aşamasında</div>
    </div>

@endsection

@section('page-styles')
    @include('pages.opportunity.show.comment.components.style')
@stop

@section('page-script')
    @include('pages.opportunity.show.comment.components.script')
@stop
