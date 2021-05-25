@extends('layouts.master')
@section('title', $customer->title . ' - Müşteri Detayları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')

    @include('mobile.customer.show.layouts.subheader')
    @include('mobile.customer.show.offer.modals.create')
    @include('mobile.customer.show.offer.modals.edit')

    @include('mobile.customer.show.offer.modals.create-offer-item')

    <div class="row">
        <div class="col-6">
            @Authority(46)
            <button class="btn btn-primary" onclick="create()">Yeni Oluştur</button>
            @endAuthority
        </div>
        <div class="col-6 text-right">
            <div class="row">
                @Authority(47)
                <div class="col-12">
                    <button id="EditButton" class="btn btn-dark-75" onclick="edit()" style="display: none">Düzenle</button>
                </div>
                @endAuthority
            </div>
        </div>
    </div>
    <hr>
    <div class="row mt-15">
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
    @include('mobile.customer.show.offer.components.style')
@stop

@section('page-script')
    @include('mobile.customer.show.offer.components.script')
@stop
