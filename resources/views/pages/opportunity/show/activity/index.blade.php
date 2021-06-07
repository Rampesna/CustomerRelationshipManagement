@extends('layouts.master')
@section('title', 'Fırsat Detayları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.opportunity.show.layouts.subheader')
    @include('pages.opportunity.show.activity.components.create')
    @include('pages.opportunity.show.activity.components.edit')

    @include('pages.opportunity.show.activity.modals.delete')

    <div class="row mt-15">
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
            {{--            <a onclick="show()" class="dropdown-item cursor-pointer">--}}
            {{--                <div class="row">--}}
            {{--                    <div class="col-xl-12">--}}
            {{--                        <i class="fas fa-eye text-info"></i><span class="ml-4">İncele</span>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </a>--}}

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
    @include('pages.opportunity.show.activity.components.style')
@stop

@section('page-script')
    @include('pages.opportunity.show.activity.components.script')
@stop
