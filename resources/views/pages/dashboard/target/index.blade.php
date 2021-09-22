@extends('layouts.master')
@section('title', 'Hedef Durumu')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.dashboard.layouts.subheader')

    <div class="row mt-15">
        <div class="col-xl-2">
            <div class="form-group">
                <label style="width: 100%">
                    <input type="date" id="start_date" class="form-control" value="{{ date('Y-m-01') }}">
                </label>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="form-group">
                <label style="width: 100%">
                    <input type="date" id="end_date" class="form-control" value="{{ date('Y-m-t') }}">
                </label>
            </div>
        </div>
        <div class="col-xl-1">
            <button class="btn btn-sm mt-1 btn-success" id="FilterButton">Filtrele</button>
        </div>
    </div>
    <hr class="mt-n6">
    <div class="row" id="usersRow">

    </div>

@endsection

@section('page-styles')
    @include('pages.dashboard.target.components.style')
@stop

@section('page-script')
    @include('pages.dashboard.target.components.script')
@stop
