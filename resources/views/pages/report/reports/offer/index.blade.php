@extends('layouts.master')
@section('title', 'Teklif Raporları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')

    <div class="row">
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
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="subject_filterer">Konu</label>
                                <input type="text" id="subject_filterer" class="form-control filterer">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="pay_types">Ödeme Türü</label>
                                <select id="pay_types" class="form-control selectpicker" data-live-search="true" multiple>

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="delivery_types">Teslim Türü</label>
                                <select id="delivery_types" class="form-control selectpicker" data-live-search="true" multiple>

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="statuses">Durum</label>
                                <select id="statuses" class="form-control selectpicker" data-live-search="true" multiple>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 text-right">
                            <button class="btn btn-sm btn-primary" id="ClearFilterButton">Temizle</button>
                            <button class="btn btn-sm btn-success" id="FilterButton">Filtrele</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="offersCard">
                <div class="card-body">
                    <table class="table" id="offers">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Temsilci</th>
                            <th>Firma</th>
                            <th>Bağlantı Türü</th>
                            <th>Bağlantı</th>
                            <th>Konu</th>
                            <th>Geçerlilik Tarihi</th>
                            <th>Ödeme Türü</th>
                            <th>Teslim Türü</th>
                            <th>Döviz</th>
                            <th>Kur</th>
                            <th>Durum</th>
                            <th>Açıklamalar</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Temsilci</th>
                            <th>Firma</th>
                            <th>Bağlantı Türü</th>
                            <th>Bağlantı</th>
                            <th>Konu</th>
                            <th>Geçerlilik Tarihi</th>
                            <th>Ödeme Türü</th>
                            <th>Teslim Türü</th>
                            <th>Döviz</th>
                            <th>Kur</th>
                            <th>Durum</th>
                            <th>Açıklamalar</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.report.reports.offer.components.style')
@stop

@section('page-script')
    @include('pages.report.reports.offer.components.script')
@stop
