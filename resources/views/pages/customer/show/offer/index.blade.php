@extends('layouts.master')
@section('title', $customer->title . ' - Müşteri Detayları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')

    @include('pages.customer.show.layouts.subheader')
    @include('pages.customer.show.offer.components.create')
    @include('pages.customer.show.offer.components.edit')

    @include('pages.customer.show.offer.modals.create-offer-item')

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
            <a onclick="show()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-eye text-info"></i><span class="ml-4">İncele</span>
                    </div>
                </div>
            </a>


            @Authority(47)
            <a onclick="edit()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-pen text-primary"></i><span class="ml-4">Düzenle</span>
                    </div>
                </div>
            </a>
            @endAuthority

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
    @include('pages.customer.show.offer.components.style')
@stop

@section('page-script')
    @include('pages.customer.show.offer.components.script')
@stop
