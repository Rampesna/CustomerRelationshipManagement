@extends('layouts.master')
@section('title', 'Stoklar')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.stock.components.create')
    @include('pages.stock.components.edit')
    @include('pages.stock.modals.delete')

    <div id="isMobile">
        <div class="row">
            <div class="col-4">
                @Authority(51)
                <button class="btn btn-primary btn-block" onclick="create()">Yeni Oluştur</button>
                @endAuthority
            </div>
            <div class="col-4">
                <div class="row">
                    @Authority(52)
                    <div class="col-12">
                        <button class="btn btn-dark-75 btn-block" onclick="edit()">Düzenle</button>
                    </div>
                    @endAuthority
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    @Authority(53)
                    <div class="col-12">
                        <button class="btn btn-danger btn-block" onclick="drop()">Sil</button>
                    </div>
                    @endAuthority
                </div>
            </div>
        </div>
        <hr>
    </div>
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

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        @Authority(51)
        <a onclick="create()" class="dropdown-item cursor-pointer">
            <div class="row">
                <div class="col-xl-12">
                    <i class="fas fa-plus-circle text-success"></i><span class="ml-4">Yeni Oluştur</span>
                </div>
            </div>
        </a>
        @endAuthority
        <div id="EditingContexts">
            <hr>
{{--            <a onclick="show()" class="dropdown-item cursor-pointer">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-xl-12">--}}
{{--                        <i class="fas fa-eye text-info"></i><span class="ml-4">İncele</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}
            @Authority(52)
            <a onclick="edit()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-pen text-primary"></i><span class="ml-4">Düzenle</span>
                    </div>
                </div>
            </a>
            @endAuthority

            @Authority(53)
            <a onclick="drop()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-trash-alt text-danger"></i><span class="ml-4">Sil</span>
                    </div>
                </div>
            </a>
            @endAuthority
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.stock.components.style')
@stop

@section('page-script')
    @include('pages.stock.components.script')
@stop
