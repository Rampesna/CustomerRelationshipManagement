@extends('layouts.master')
@section('title', 'Fırsat Raporları')
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
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="name_filterer">Ünvan</label>
                                <input type="text" id="name_filterer" class="form-control filterer">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="email_filterer">E-posta Adresi</label>
                                <input type="text" id="email_filterer" class="form-control decimal filterer">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="phone_number_filterer">Telefon Numarası</label>
                                <input type="text" id="phone_number_filterer" class="form-control decimal filterer">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="website_filterer">Website</label>
                                <input type="text" id="website_filterer" class="form-control decimal filterer">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="countries">Ülke</label>
                                <select id="countries" class="form-control selectpicker" data-live-search="true" multiple>

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="provinces">Şehir</label>
                                <select id="provinces" class="form-control selectpicker" data-live-search="true" multiple>

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="priorities">Öncelik Durumu</label>
                                <select id="priorities" class="form-control selectpicker" data-live-search="true" multiple>

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="access_types">Erişim Türü</label>
                                <select id="access_types" class="form-control selectpicker" data-live-search="true" multiple>

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="min_capacity">Min. Kapasite</label>
                                        <input type="text" id="min_capacity" class="form-control decimal filterer">
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="max_capacity">Max. Kapasite</label>
                                        <input type="text" id="max_capacity" class="form-control decimal filterer">
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="capacity_types">Kapasite Türü</label>
                                        <select id="capacity_types" class="form-control selectpicker" data-live-search="true" multiple>

                                        </select>
                                    </div>
                                </div>
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
            <div class="card" id="opportunitiesCard">
                <div class="card-body">
                    <table class="table" id="opportunities">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Firma</th>
                            <th>Fırsat Tarihi</th>
                            <th>Durum</th>
                            <th>Temsilci</th>
                            <th>Fırst Müşterisi</th>
                            <th>Müşteri Bağlantısı</th>
                            <th>Yerli/Yabancı</th>
                            <th>Ülke</th>
                            <th>Şehir</th>
                            <th>İlçe</th>
                            <th>E-posta Adresi</th>
                            <th>Telefon Numarası</th>
                            <th>Yetkili Ad Soyad</th>
                            <th>Yetkili E-posta</th>
                            <th>Yetkili Telefon</th>
                            <th>Website</th>
                            <th>Tutar</th>
                            <th>Döviz Türü</th>
                            <th>Öncelik</th>
                            <th>Erişim Türü</th>
                            <th>Firma Kuruluş Tarihi</th>
                            <th>Tahmini Sonuçlanma</th>
                            <th>Tahmini Sonuçlanma Türü</th>
                            <th>Kapasite</th>
                            <th>Kapasite Türü</th>
                            <th>Açıklamalar</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Firma</th>
                            <th>Fırsat Tarihi</th>
                            <th>Durum</th>
                            <th>Temsilci</th>
                            <th>Fırst Müşterisi</th>
                            <th>Müşteri Bağlantısı</th>
                            <th>Yerli/Yabancı</th>
                            <th>Ülke</th>
                            <th>Şehir</th>
                            <th>İlçe</th>
                            <th>E-posta Adresi</th>
                            <th>Telefon Numarası</th>
                            <th>Yetkili Ad Soyad</th>
                            <th>Yetkili E-posta</th>
                            <th>Yetkili Telefon</th>
                            <th>Website</th>
                            <th>Tutar</th>
                            <th>Döviz Türü</th>
                            <th>Öncelik</th>
                            <th>Erişim Türü</th>
                            <th>Firma Kuruluş Tarihi</th>
                            <th>Tahmini Sonuçlanma</th>
                            <th>Tahmini Sonuçlanma Türü</th>
                            <th>Kapasite</th>
                            <th>Kapasite Türü</th>
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
    @include('pages.report.reports.opportunity.components.style')
@stop

@section('page-script')
    @include('pages.report.reports.opportunity.components.script')
@stop
