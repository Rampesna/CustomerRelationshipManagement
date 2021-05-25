@extends('mobile.layouts.master')
@section('title', 'Aktiviteler')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('mobile.opportunity.show.layouts.subheader')
    @include('mobile.opportunity.show.activity.modals.create')
    @include('mobile.opportunity.show.activity.modals.edit')

    <div class="row">
        <div class="col-6">
            @Authority(20)
            <button class="btn btn-primary" onclick="create()">Yeni Oluştur</button>
            @endAuthority
        </div>
        <div class="col-6 text-right">
            <div class="row">
                @Authority(21)
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
            <div class="card" id="activitiesCard">
                <div class="card-body">
                    <table class="table" id="activities">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Konu</th>
                            <th>Firma</th>
                            <th>Temsilci</th>
                            <th>Başlangıç Tarihi</th>
                            <th>Bitiş Tarihi</th>
                            <th>Görüşme Nedeni</th>
                            <th>Öncelik</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Konu</th>
                            <th>Firma</th>
                            <th>Temsilci</th>
                            <th>Başlangıç Tarihi</th>
                            <th>Bitiş Tarihi</th>
                            <th>Görüşme Nedeni</th>
                            <th>Öncelik</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('mobile.opportunity.show.activity.components.style')
@stop

@section('page-script')
    @include('mobile.opportunity.show.activity.components.script')
@stop
