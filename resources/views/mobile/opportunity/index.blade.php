@extends('mobile.layouts.master')
@section('title', 'Fırsatlar')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('mobile.opportunity.modals.create')
    @include('mobile.opportunity.modals.edit')

    <div class="row">
        <div class="col-6">
            @Authority(14)
            <button class="btn btn-primary" onclick="create()">Yeni Oluştur</button>
            @endAuthority
        </div>
        <div class="col-6 text-right">
            <div class="row">
                <div class="col-6">
                    <button id="ShowButton" class="btn btn-info" onclick="show()" style="display: none">İncele</button>
                </div>
                @Authority(15)
                <div class="col-6">
                    <button id="EditButton" class="btn btn-dark-75" onclick="edit()" style="display: none">Düzenle</button>
                </div>
                @endAuthority
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="opportunitiesCard">
                <div class="card-body">
                    <table class="table" id="opportunities">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Müşteri</th>
                            <th>Fırsat Müşterisi</th>
                            <th>Firma</th>
                            <th>Tarih</th>
                            <th>Öncelik</th>
                            <th>Temsilci</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Müşteri</th>
                            <th>Fırsat Müşterisi</th>
                            <th>Firma</th>
                            <th>Tarih</th>
                            <th>Öncelik</th>
                            <th>Temsilci</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('mobile.opportunity.components.style')
@stop

@section('page-script')
    @include('mobile.opportunity.components.script')
@stop
