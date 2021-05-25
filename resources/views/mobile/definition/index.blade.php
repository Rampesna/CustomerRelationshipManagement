@extends('mobile.layouts.master')
@section('title', 'Tanımlamalar')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')

    @include('mobile.definition.modals.edit')

    <div class="row">
        <div class="col-6"></div>
        <div class="col-6 text-right">
            <div class="row">
                <div class="col-12">
                    @Authority(62)
                    <button id="EditButton" class="btn btn-dark-75" onclick="edit()" style="display: none">Düzenle</button>
                    @endAuthority
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="definitionsCard">
                <div class="card-body">
                    <table class="table" id="definitions">
                        <thead>
                        <tr>
                            <th>Tanımlama</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Tanımlama</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('mobile.definition.components.style')
@stop

@section('page-script')
    @include('mobile.definition.components.script')
@stop
