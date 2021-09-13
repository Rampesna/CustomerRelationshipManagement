@extends('layouts.master')
@section('title', 'Hedef Raporları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')

    <form class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    Detaylı Arama
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="users">Temsilciler</label>
                                <select id="users" class="form-control filterer" multiple>

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="start_date">Başlangıç Tarihi</label>
                                <input type="date" id="start_date" value="" class="form-control filterer">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="end_date">Bitiş Tarihi</label>
                                <input type="date" id="end_date" value="" class="form-control filterer">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 text-right">
                            <button type="button" class="btn btn-sm btn-primary" id="ClearFilterButton">Temizle</button>
                            <button type="button" class="btn btn-sm btn-success" id="FilterButton">Filtrele</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <hr>
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="targetsCard">
                <div class="card-body">
                    <table class="table" id="targets">
                        <thead>
                        <tr>
                            <th>Temsilci</th>
                            <th>Fırsat Hedef Durumu</th>
                            <th>Aktivite Hedef Durumu</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Temsilci</th>
                            <th>Fırsat Hedef Durumu</th>
                            <th>Aktivite Hedef Durumu</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.report.reports.target.components.style')
@stop

@section('page-script')
    @include('pages.report.reports.target.components.script')
@stop
