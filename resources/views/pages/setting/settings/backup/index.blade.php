@extends('layouts.master')
@section('title', 'Yedekleme Ayarları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="database_backup_path">Veritabanının Yedekleneceği Klasör</label>
                                <input id="database_backup_path" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-12 text-right">
                            <button id="UpdateButton" class="btn btn-success">Güncelle</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.setting.settings.backup.components.style')
@stop

@section('page-script')
    @include('pages.setting.settings.backup.components.script')
@stop
