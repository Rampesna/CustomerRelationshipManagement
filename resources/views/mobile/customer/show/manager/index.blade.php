@extends('layouts.master')
@section('title', $customer->title . ' - Müşteri Detayları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')

    @include('mobile.customer.show.layouts.subheader')
    @include('mobile.customer.show.manager.modals.create')
    @include('mobile.customer.show.manager.modals.edit')

    <div class="row">
        <div class="col-6">
            @Authority(36)
            <button class="btn btn-primary" onclick="create()">Yeni Oluştur</button>
            @endAuthority
        </div>
        <div class="col-6 text-right">
            <div class="row">
                @Authority(37)
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
            <div class="card" id="managersCard">
                <div class="card-body">
                    <table class="table" id="managers">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Adı</th>
                            <th>E-posta</th>
                            <th>Telefon</th>
                            <th>Cinsiyet</th>
                            <th>Departman</th>
                            <th>Ünvan</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Adı</th>
                            <th>E-posta</th>
                            <th>Telefon</th>
                            <th>Cinsiyet</th>
                            <th>Departman</th>
                            <th>Ünvan</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('mobile.customer.show.manager.components.style')
@stop

@section('page-script')
    @include('mobile.customer.show.manager.components.script')
@stop
