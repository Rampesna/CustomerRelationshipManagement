@extends('mobile.layouts.master')
@section('title', 'Stoklar')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('mobile.stock.modals.create')
    @include('mobile.stock.modals.edit')

    <div class="row">
        <div class="col-6">
            @Authority(51)
            <button class="btn btn-primary" onclick="create()">Yeni Oluştur</button>
            @endAuthority
        </div>
        <div class="col-6 text-right">
            <div class="row">
                @Authority(52)
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
            <div class="card" id="stocksCard">
                <div class="card-body">
                    <table class="table" id="stocks">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Kodu</th>
                            <th>Adı</th>
                            <th>Stok</th>
                            <th>Birim</th>
                            <th>Birim Fiyat</th>
                            <th>Tip</th>
                            <th>Durum</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Kodu</th>
                            <th>Adı</th>
                            <th>Stok</th>
                            <th>Birim</th>
                            <th>Birim Fiyat</th>
                            <th>Tip</th>
                            <th>Durum</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('mobile.stock.components.style')
@stop

@section('page-script')
    @include('mobile.stock.components.script')
@stop
