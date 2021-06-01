@extends('layouts.master')
@section('title', 'Profil Düzenle')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    Kişisel Bilgiler
                </div>
                <div class="card-body">
                    <form id="updateProfileForm">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="name">Ad Soyad</label>
                                    <input type="text" id="name" class="form-control" value="{{ auth()->user()->name() }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="phone_number">Telefon Numarası</label>
                                    <input type="text" id="phone_number" class="form-control mobile-phone-number" value="{{ auth()->user()->phoneNumber() }}">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-xl-12 text-right">
                            <button class="btn btn-sm btn-success" type="button" id="updateProfile">Güncelle</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    Güvenlik
                </div>
                <div class="card-body">
                    <form id="updatePasswordForm">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="old_password">Eski Şifreniz</label>
                                    <input type="password" id="old_password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="new_password">Yeni Şifreniz</label>
                                    <input type="password" id="new_password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="confirm_new_password">Yeni Şifrenizi Tekrarlayın</label>
                                    <input type="password" id="confirm_new_password" class="form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-xl-12 text-right">
                            <button class="btn btn-sm btn-success" type="button" id="updatePassword">Güncelle</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.profile.components.style')
@stop

@section('page-script')
    @include('pages.profile.components.script')
@stop
