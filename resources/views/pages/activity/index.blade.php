@extends('layouts.master')
@section('title', 'Aktiviteler')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.activity.components.create')
    @include('pages.activity.components.edit')

    @include('pages.activity.modals.delete')

    <div id="isMobile">
        <div class="row">
            <div class="col-4">
                @Authority(20)
                <button class="btn btn-primary btn-block" onclick="create()">Yeni Oluştur</button>
                @endAuthority
            </div>
            <div class="col-4">
                <div class="row">
                    @Authority(21)
                    <div class="col-12">
                        <button class="btn btn-dark-75 btn-block" onclick="edit()">Düzenle</button>
                    </div>
                    @endAuthority
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    @Authority(22)
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
            <div class="card" id="activitiesCard">
                <div class="card-body">
                    <table class="table" id="activities">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Bağlantı Türü</th>
                            <th>Bağlantı</th>
                            <th>Konu</th>
                            <th>Firma</th>
                            <th>Temsilci</th>
                            <th>Başlangıç Tarihi</th>
                            <th>Şehir</th>
                            <th>Görüşme Nedeni</th>
                            <th>Öncelik</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Bağlantı Türü</th>
                            <th>Bağlantı</th>
                            <th>Konu</th>
                            <th>Firma</th>
                            <th>Temsilci</th>
                            <th>Başlangıç Tarihi</th>
                            <th>Şehir</th>
                            <th>Görüşme Nedeni</th>
                            <th>Öncelik</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        @Authority(20)
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
            @Authority(21)
            <a onclick="edit()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-pen text-primary"></i><span class="ml-4">Düzenle</span>
                    </div>
                </div>
            </a>
            @endAuthority

            @Authority(22)
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
    @include('pages.activity.components.style')
@stop

@section('page-script')
    @include('pages.activity.components.script')
@stop
