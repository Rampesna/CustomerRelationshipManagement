@extends('layouts.master')
@section('title', $customer->title . ' - Yetkililer')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')

    @include('pages.customer.show.layouts.subheader')
    @include('pages.customer.show.manager.components.create')
    @include('pages.customer.show.manager.components.edit')

    @include('pages.customer.show.manager.modals.delete')

    <div class="row mt-30">
        <div class="col-xl-12">
            <div class="card" id="managersCard">
                <div class="card-body">
                    <table class="table" id="managers">
                        <thead>
                        <tr>
                            <th>#</th>
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
        <a onclick="create()" class="dropdown-item cursor-pointer">
            <div class="row">
                <div class="col-xl-12">
                    <i class="fas fa-plus-circle text-success"></i><span class="ml-4">Yeni Oluştur</span>
                </div>
            </div>
        </a>
        <div id="EditingContexts">
            <hr>
            {{--            <a onclick="show()" class="dropdown-item cursor-pointer">--}}
            {{--                <div class="row">--}}
            {{--                    <div class="col-xl-12">--}}
            {{--                        <i class="fas fa-eye text-info"></i><span class="ml-4">İncele</span>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </a>--}}
            <a onclick="edit()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-pen text-primary"></i><span class="ml-4">Düzenle</span>
                    </div>
                </div>
            </a>
            <a onclick="drop()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-trash-alt text-danger"></i><span class="ml-4">Sil</span>
                    </div>
                </div>
            </a>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.customer.show.manager.components.style')
@stop

@section('page-script')
    @include('pages.customer.show.manager.components.script')
@stop
