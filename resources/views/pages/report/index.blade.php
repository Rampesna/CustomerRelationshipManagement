@extends('layouts.master')
@section('title', 'Raporlar')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')

    <div class="row">
        <div class="col-xl-12">

        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.report.components.style')
@stop

@section('page-script')
    @include('pages.report.components.script')
@stop
