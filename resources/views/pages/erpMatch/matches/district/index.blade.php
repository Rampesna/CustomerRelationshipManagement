@extends('layouts.master')
@section('title', 'İlçe Eşleşmeleri')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')

    @include('pages.erpMatch.matches.district.modals.delete')

    <input type="hidden" id="id_edit">
    <input type="hidden" id="guid_edit">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-5">
                            <div class="form-group">
                                <label for="id_create">CRM</label>
                                <select id="id_create" class="form-control selectpicker" data-live-search="true">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-5">
                            <div class="form-group">
                                <label for="guid_create">Ticari Program</label>
                                <select id="guid_create" class="form-control selectpicker" data-live-search="true">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <button class="btn btn-success btn-sm btn-block mt-9" id="CreateButton">Ekle</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="matchesCard">
                <div class="card-body">
                    <table class="table" id="matches">
                        <thead>
                        <tr>
                            <th>CRM</th>
                            <th>Ticari Program</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>CRM</th>
                            <th>Ticari Program</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        <a onclick="drop()" class="dropdown-item cursor-pointer">
            <div class="row">
                <div class="col-xl-12">
                    <i class="fas fa-trash-alt text-danger"></i><span class="ml-4">Sil</span>
                </div>
            </div>
        </a>
    </div>

@endsection

@section('page-styles')
    @include('pages.erpMatch.matches.district.components.style')
@stop

@section('page-script')
    @include('pages.erpMatch.matches.district.components.script')
@stop
