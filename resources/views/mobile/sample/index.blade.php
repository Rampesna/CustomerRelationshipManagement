@extends('mobile.layouts.master')
@section('title', 'Numuneler')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('mobile.sample.modals.create')
    @include('mobile.sample.modals.edit')

    @include('mobile.sample.modals.create-sample-item')

    <div class="row">
        <div class="col-6">
            @Authority(41)
            <button class="btn btn-primary" onclick="create()">Yeni Oluştur</button>
            @endAuthority
        </div>
        <div class="col-6 text-right">
            <div class="row">
                @Authority(42)
                <div class="col-12">
                    <button id="EditButton" class="btn btn-dark-75" onclick="edit()" style="display: none">Düzenle</button>
                </div>
                @endAuthority
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="samplesCard">
                <div class="card-body">
                    <table class="table" id="samples">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Konu</th>
                            <th>Bağlantı Türü</th>
                            <th>Bağlantı</th>
                            <th>Tarih</th>
                            <th>Durum</th>
                            <th>Firma</th>
                            <th>Temsilci</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Konu</th>
                            <th>Bağlantı Türü</th>
                            <th>Bağlantı</th>
                            <th>Tarih</th>
                            <th>Durum</th>
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
    @include('mobile.sample.components.style')
@stop

@section('page-script')
    @include('mobile.sample.components.script')
@stop
