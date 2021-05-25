@extends('mobile.layouts.master')
@section('title', 'Fiyat Listeleri')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('mobile.priceList.modals.create')
    @include('mobile.priceList.modals.edit')

    @include('mobile.priceList.modals.create-price-list-item')

    <div class="row">
        <div class="col-6">
            @Authority(56)
            <button class="btn btn-primary" onclick="create()">Yeni Oluştur</button>
            @endAuthority
        </div>
        <div class="col-6 text-right">
            <div class="row">
                @Authority(57)
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
            <div class="card" id="priceListsCard">
                <div class="card-body">
                    <table class="table" id="priceLists">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Adı</th>
                            <th>Başlangıç Tarihi</th>
                            <th>Bitiş Tarihi</th>
                            <th>Durum</th>
                            <th>Firma</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Adı</th>
                            <th>Başlangıç Tarihi</th>
                            <th>Bitiş Tarihi</th>
                            <th>Durum</th>
                            <th>Firma</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('mobile.priceList.components.style')
@stop

@section('page-script')
    @include('mobile.priceList.components.script')
@stop
