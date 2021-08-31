@extends('layouts.master')
@section('title', 'Fiyat Listeleri')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.priceList.components.create')
    @include('pages.priceList.components.edit')

    @include('pages.priceList.modals.create-price-list-item')
    @include('pages.priceList.modals.edit-price-list-item')
    @include('pages.priceList.modals.copy')
    @include('pages.priceList.modals.delete')
    @include('pages.priceList.modals.send-email')

    <div id="isMobile">
        <div class="row">
            <div class="col-4">
                @Authority(56)
                <button class="btn btn-primary btn-block" onclick="create()">Yeni Oluştur</button>
                @endAuthority
            </div>
            <div class="col-4">
                <div class="row">
                    @Authority(57)
                    <div class="col-12">
                        <button class="btn btn-dark-75 btn-block" onclick="edit()">Düzenle</button>
                    </div>
                    @endAuthority
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    @Authority(58)
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

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        @Authority(56)
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
            @Authority(57)
            <a onclick="edit()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-pen text-primary"></i><span class="ml-4">Düzenle</span>
                    </div>
                </div>
            </a>
            @endAuthority

            @Authority(57)
            <a onclick="copy()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="far fa-copy text-dark-75"></i><span class="ml-4">Kopyasını Oluştur</span>
                    </div>
                </div>
            </a>
            @endAuthority

            <a onclick="downloadPDF()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-download text-success"></i><span class="ml-4">İndir</span>
                    </div>
                </div>
            </a>

            <a onclick="sendEmailModal()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-envelope-open text-info"></i><span class="ml-4">Mail Gönder</span>
                    </div>
                </div>
            </a>

            @Authority(58)
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
    @include('pages.priceList.components.style')
@stop

@section('page-script')
    @include('pages.priceList.components.script')
@stop
