@extends('layouts.master')
@section('title', 'Rapor')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.dashboard.layouts.subheader')

    <div class="row mt-15">
        <div class="col-xl-2">
            <label for="opportunity_statuses">Fırsat Durumları</label>
            <select id="opportunity_statuses" class="form-control selectpicker" data-live-search="true" title="Tümü" multiple></select>
        </div>
        <div class="col-xl-2">
            <label for="activity_meeting_reasons">Aktivite Nedenleri</label>
            <select id="activity_meeting_reasons" class="form-control selectpicker" data-live-search="true" title="Tümü" multiple></select>
        </div>
        <div class="col-xl-2" style="margin-top: 1.85rem">
            <div class="form-group">
                <label style="width: 100%">
                    <input type="date" id="start_date" class="form-control" value="{{ date("Y-m-d", strtotime('monday this week')) }}">
                </label>
            </div>
        </div>
        <div class="col-xl-2" style="margin-top: 1.85rem">
            <div class="form-group">
                <label style="width: 100%">
                    <input type="date" id="end_date" class="form-control" value="{{ date("Y-m-d", strtotime('sunday this week')) }}">
                </label>
            </div>
        </div>
        <div class="col-xl-1" style="margin-top: 1.80rem">
            <button class="btn btn-sm mt-1 btn-success btn-block" id="FilterButton">Filtrele</button>
        </div>
    </div>
    <hr class="mt-n4">
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header pb-2 pt-4">
                    <div class="row">
                        <div class="col-xl-12 text-center">
                            <h6>Fırsat Raporu</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body text-center">
                    <div id="opportunityPieChartDiv"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header pb-2 pt-4">
                    <div class="row">
                        <div class="col-xl-12 text-center">
                            <h6>Aktivite Raporu</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body text-center">
                    <div id="activityPieChartDiv"></div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div id="timelineChartDiv"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.dashboard.report.components.style')
@stop

@section('page-script')
    @include('pages.dashboard.report.components.script')
@stop
