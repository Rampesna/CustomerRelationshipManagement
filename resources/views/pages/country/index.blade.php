@extends('layouts.master')
@section('title', 'Ülkeler')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')

    <div class="row">
        <div class="col-xl-12">

        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.country.components.style')
@stop

@section('page-script')
    @include('pages.country.components.script')
@stop
