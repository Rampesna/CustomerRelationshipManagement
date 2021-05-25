@extends('mobile.layouts.master')
@section('title', 'Müşteriler')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('mobile.customer.modals.create')
    @include('mobile.customer.modals.edit')

    <div class="row">
        <div class="col-6">
            @Authority(25)
            <button class="btn btn-primary" onclick="create()">Yeni Oluştur</button>
            @endAuthority
        </div>
        <div class="col-6 text-right">
            <div class="row">
                <div class="col-6">
                    <button id="ShowButton" class="btn btn-info" onclick="show()" style="display: none">İncele</button>
                </div>
                <div class="col-6">
                    @Authority(26)
                    <button id="EditButton" class="btn btn-dark-75" onclick="edit()" style="display: none">Düzenle</button>
                    @endAuthority
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="customersCard">
                <div class="card-body">
                    <table class="table" id="customers">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Firma</th>
                            <th>Ünvan</th>
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
                            <th>Firma</th>
                            <th>Ünvan</th>
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

@endsection

@section('page-styles')
    @include('mobile.customer.components.style')
@stop

@section('page-script')
    @include('mobile.customer.components.script')
@stop
