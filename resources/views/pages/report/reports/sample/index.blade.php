@extends('layouts.master')
@section('title', 'Numune Raporları')
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
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="start_date">Başlangıç Tarihi</label>
                                <input type="datetime-local" id="start_date" value="" class="form-control filterer">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="end_date">Bitiş Tarihi</label>
                                <input type="datetime-local" id="end_date" value="" class="form-control filterer">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="subject_filterer">Konu</label>
                                <input type="text" id="subject_filterer" class="form-control filterer">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="statuses">Durum</label>
                                <select id="statuses" class="form-control selectpicker" data-live-search="true" multiple>

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="cargo_companies">Kargo Firması</label>
                                <select id="cargo_companies" class="form-control selectpicker" data-live-search="true" multiple>

                                </select>
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
            <div class="card" id="samplesCard">
                <div class="card-body">
                    <table class="table" id="samples">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Temsilci</th>
                            <th>Firma</th>
                            <th>Bağlantı Türü</th>
                            <th>Bağlantı</th>
                            <th>Tarih</th>
                            <th>Durum</th>
                            <th>Konu</th>
                            <th>Kargo Firması</th>
                            <th>Kargo Takip Numarası</th>
                            <th>Otobüs Firması</th>
                            <th>Araç Plakası</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Temsilci</th>
                            <th>Firma</th>
                            <th>Bağlantı Türü</th>
                            <th>Bağlantı</th>
                            <th>Tarih</th>
                            <th>Durum</th>
                            <th>Konu</th>
                            <th>Kargo Firması</th>
                            <th>Kargo Takip Numarası</th>
                            <th>Otobüs Firması</th>
                            <th>Araç Plakası</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.report.reports.sample.components.style')
@stop

@section('page-script')
    @include('pages.report.reports.sample.components.script')
@stop
