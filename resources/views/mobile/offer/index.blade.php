@extends('mobile.layouts.master')
@section('title', 'Teklifler')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('mobile.offer.modals.create')
    @include('mobile.offer.modals.edit')
    @include('mobile.offer.modals.create-offer-item')

    <div class="row">
        <div class="col-6">
            <button class="btn btn-primary" onclick="create()">Yeni Oluştur</button>
        </div>
        <div class="col-6 text-right">
            <div class="row">
                <div class="col-12">
                    <button id="EditButton" class="btn btn-dark-75" onclick="edit()" style="display: none">Düzenle</button>
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
                            <th>Konu</th>
                            <th>Geçerlilik Tarihi</th>
                            <th>Durum</th>
                            <th>Bağlantı Türü</th>
                            <th>Bağlantı</th>
                            <th>Firma</th>
                            <th>Temsilci</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Konu</th>
                            <th>Geçerlilik Tarihi</th>
                            <th>Durum</th>
                            <th>Bağlantı Türü</th>
                            <th>Bağlantı</th>
                            <th>Firma</th>
                            <th>Temsilci</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('mobile.offer.components.style')
@stop

@section('page-script')
    @include('mobile.offer.components.script')
@stop
