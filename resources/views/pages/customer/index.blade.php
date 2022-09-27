@extends('layouts.master')
@section('title', 'Müşteriler')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.customer.components.create')
    @include('pages.customer.components.edit')
    @include('pages.customer.modals.delete')

    <div id="isMobile">
        <div class="row">
            <div class="col-4">
                @Authority(25)
                <button class="btn btn-primary btn-block" onclick="create()">Yeni Oluştur</button>
                @endAuthority
            </div>
            <div class="col-4">
                <div class="row">
                    @Authority(26)
                    <div class="col-12">
                        <button class="btn btn-dark-75 btn-block" onclick="edit()">Düzenle</button>
                    </div>
                    @endAuthority
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    @Authority(27)
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
            <div class="card" id="customersCard">
                <div class="card-body">
                    <table class="table" id="customers">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Bayi</th>
                            <th>Temsilci</th>
                            <th>Firma</th>
                            <th>Ünvan</th>
                            <th>Bakiye</th>
                            <th>Şehir</th>
                            <th>Vergi No</th>
                            <th>E-posta</th>
                            <th>Ülke</th>
                            <th>Telefon</th>
                            <th>Sınıf</th>
                            <th>Tip</th>
                            <th>Referans</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Bayi</th>
                            <th>Temsilci</th>
                            <th>Firma</th>
                            <th>Ünvan</th>
                            <th>Bakiye</th>
                            <th>Şehir</th>
                            <th>Vergi No</th>
                            <th>E-posta</th>
                            <th>Ülke</th>
                            <th>Telefon</th>
                            <th>Sınıf</th>
                            <th>Tip</th>
                            <th>Referans</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        @Authority(25)
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

            @Authority(26)
            <a onclick="edit()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-pen text-primary"></i><span class="ml-4">Düzenle</span>
                    </div>
                </div>
            </a>
            @endAuthority

            @Authority(27)
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
    @include('pages.customer.components.style')
@stop

@section('page-script')
    @include('pages.customer.components.script')
@stop
