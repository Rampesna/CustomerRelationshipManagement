@extends('layouts.master')
@section('title', 'Kullanıcılar')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.user.components.create')
    @include('pages.user.components.edit')
    @include('pages.user.modals.delete')

    <div id="isMobile">
        <div class="row">
            <div class="col-4">
                @Authority(4)
                <button class="btn btn-primary btn-block" onclick="create()">Yeni Oluştur</button>
                @endAuthority
            </div>
            <div class="col-4">
                <div class="row">
                    @Authority(5)
                    <div class="col-12">
                        <button class="btn btn-dark-75 btn-block" onclick="edit()">Düzenle</button>
                    </div>
                    @endAuthority
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    @Authority(6)
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
        <div class="col-xl-2">
            <label for="listing"></label>
            <select id="listing" class="form-control selectpicker">
                <option value="all">Tümü</option>
                <option value="active">Aktif Kullanıcılar</option>
                <option value="passive">Pasif Kullanıcılar</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="usersCard">
                <div class="card-body">
                    <table class="table" id="users">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Ad Soyad</th>
                            <th>E-posta Adresi</th>
                            <th>Telefon Numarası</th>
                            <th>Rol</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Ad Soyad</th>
                            <th>E-posta Adresi</th>
                            <th>Telefon Numarası</th>
                            <th>Rol</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        @Authority(4)
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

            @Authority(5)
            <a onclick="edit()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-pen text-primary"></i><span class="ml-4">Düzenle</span>
                    </div>
                </div>
            </a>
            @endAuthority

            @Authority(6)
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
    @include('pages.user.components.style')
@stop

@section('page-script')
    @include('pages.user.components.script')
@stop
