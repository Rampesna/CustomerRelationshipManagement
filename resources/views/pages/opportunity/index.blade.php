@extends('layouts.master')
@section('title', 'Fırsatlar')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.opportunity.components.create')
    @include('pages.opportunity.components.edit')
    @include('pages.opportunity.modals.delete')

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

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        @Authority(14)
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
            @Authority(15)
            <a onclick="edit()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-pen text-primary"></i><span class="ml-4">Düzenle</span>
                    </div>
                </div>
            </a>
            @endAuthority

            @Authority(16)
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
    @include('pages.opportunity.components.style')
@stop

@section('page-script')
    @include('pages.opportunity.components.script')
@stop
