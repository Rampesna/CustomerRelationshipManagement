@extends('mobile.layouts.master')
@section('title', 'Roller')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('mobile.role.modals.create')
    @include('mobile.role.modals.edit')

    <div class="row">
        <div class="col-6">
            @Authority(9)
            <button class="btn btn-primary" onclick="create()">Yeni Oluştur</button>
            @endAuthority
        </div>
        <div class="col-6 text-right">
            <div class="row">
                @Authority(10)
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
            <div class="card" id="rolesCard">
                <div class="card-body">
                    <table class="table" id="roles">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Rol</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('mobile.role.components.style')
@stop

@section('page-script')
    @include('mobile.role.components.script')
@stop
