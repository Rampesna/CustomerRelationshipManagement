@extends('mobile.layouts.master')
@section('title', 'Yetkililer')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('mobile.manager.modals.create')
    @include('mobile.manager.modals.edit')

    <div class="row">
        <div class="col-6">
            <button class="btn btn-primary" onclick="create()">Yeni Oluştur</button>
        </div>
        <div class="col-6 text-right">
            <div class="row">
                <div class="col-12">
                    <button id="EditButton" class="btn btn-dark-75" onclick="edit()" style="display: none">Düzenle</button>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="managersCard">
                <div class="card-body">
                    <table class="table" id="managers">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Müşteri</th>
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
                            <th>Müşteri</th>
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

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        @Authority(36)
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
            @Authority(37)
            <a onclick="edit()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-pen text-primary"></i><span class="ml-4">Düzenle</span>
                    </div>
                </div>
            </a>
            @endAuthority

            @Authority(38)
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
    @include('mobile.manager.components.style')
@stop

@section('page-script')
    @include('mobile.manager.components.script')
@stop
