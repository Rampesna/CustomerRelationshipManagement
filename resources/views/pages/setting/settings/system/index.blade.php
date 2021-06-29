@extends('layouts.master')
@section('title', 'Sistem Ayarları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')

    @include('pages.setting.settings.system.modals.edit-send-opportunity-email')

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-secondary mr-4" id="edit_send_opportunity_email">Şablonu Düzenle <i class="fa fa-pen fa-sm"></i></button>
                        <label class="checkbox checkbox-success">
                            <input type="checkbox" id="send_opportunity_email" /> Yeni Fırsat Oluşturulduğunda E-posta Gönderilsin
                            <span></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-secondary mr-4">Şablonu Düzenle <i class="fa fa-pen fa-sm"></i></button>
                        <label class="checkbox checkbox-success">
                            <input type="checkbox" id="send_activity_email" /> Yeni Aktivite Oluşturulduğunda E-posta Gönderilsin
                            <span></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-secondary mr-4">Şablonu Düzenle <i class="fa fa-pen fa-sm"></i></button>
                        <label class="checkbox checkbox-success">
                            <input type="checkbox" id="send_customer_email" /> Yeni Müşteri Oluşturulduğunda E-posta Gönderilsin
                            <span></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-secondary mr-4">Şablonu Düzenle <i class="fa fa-pen fa-sm"></i></button>
                        <label class="checkbox checkbox-success">
                            <input type="checkbox" id="send_manager_email" /> Yeni Yetkili Oluşturulduğunda E-posta Gönderilsin
                            <span></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-secondary mr-4">Şablonu Düzenle <i class="fa fa-pen fa-sm"></i></button>
                        <label class="checkbox checkbox-success">
                            <input type="checkbox" id="send_sample_email" /> Yeni Numune Oluşturulduğunda E-posta Gönderilsin
                            <span></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-secondary mr-4">Şablonu Düzenle <i class="fa fa-pen fa-sm"></i></button>
                        <label class="checkbox checkbox-success">
                            <input type="checkbox" id="send_offer_email" /> Yeni Teklif Oluşturulduğunda E-posta Gönderilsin
                            <span></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-secondary mr-4">Şablonu Düzenle <i class="fa fa-pen fa-sm"></i></button>
                        <label class="checkbox checkbox-success">
                            <input type="checkbox" id="send_stock_email" /> Yeni Stok Oluşturulduğunda E-posta Gönderilsin
                            <span></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-secondary mr-4">Şablonu Düzenle <i class="fa fa-pen fa-sm"></i></button>
                        <label class="checkbox checkbox-success">
                            <input type="checkbox" id="send_pricelist_email" /> Yeni Fiyat Listesi Oluşturulduğunda E-posta Gönderilsin
                            <span></span>
                        </label>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-12 text-right">
                            <button type="button" id="UpdateButton" class="btn btn-sm btn-success">Güncelle</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.setting.settings.system.components.style')
@stop

@section('page-script')
    @include('pages.setting.settings.system.components.script')
@stop
