@extends('layouts.master')
@section('title', 'Mail Ayarları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="mail_host">Mail Sunucusu</label>
                                <input type="text" id="mail_host" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="mail_port">Mail Portu</label>
                                <input type="text" id="mail_port" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="mail_encryption">Güvenlik</label>
                                <select id="mail_encryption" class="form-control">
                                    <option value="ssl">SSL</option>
                                    <option value="tls">TLS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="mail_username">Mail Kullanıcı Adı</label>
                                <input type="text" id="mail_username" class="form-control email-input-mask">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="mail_password">Mail Şifresi</label>
                                <input type="password" id="mail_password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="mail_recipient">Sistem Mailleri Alıcısı</label>
                                <input type="text" id="mail_recipient" class="form-control email-input-mask">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="mail_from_email">Mail Hangi E-posta Adresi Adıyla Gönderilecek</label>
                                <input type="text" id="mail_from_email" class="form-control email-input-mask">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="mail_from_name">Mail Kimin İsmiyle Gönderilecek</label>
                                <input type="text" id="mail_from_name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 text-right">
                            <button type="button" class="btn btn-sm btn-success" id="UpdateButton">Güncelle</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.setting.settings.mail.components.style')
@stop

@section('page-script')
    @include('pages.setting.settings.mail.components.script')
@stop
