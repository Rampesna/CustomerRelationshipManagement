@extends('layouts.master')
@section('title', 'Teklifler')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.offer.components.create')
    @include('pages.offer.components.edit')
    @include('pages.offer.modals.create-offer-item')
    @include('pages.offer.modals.new-offer-create-offer-item')
    @include('pages.offer.modals.delete')
    @include('pages.offer.modals.send-email')

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

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        @Authority(46)
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
            @Authority(47)
            <a onclick="edit()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-pen text-primary"></i><span class="ml-4">Düzenle</span>
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

            @Authority(48)
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
    @include('pages.offer.components.style')
@stop

@section('page-script')
    @include('pages.offer.components.script')
@stop
