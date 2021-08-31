@extends('layouts.master')
@section('title', 'Tanımlamalar')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')

    @include('pages.definition.components.edit')

    <div id="isMobile">
        <div class="row">
            <div class="col-4">
                <div class="row">
                    @Authority(62)
                    <div class="col-12">
                        <button class="btn btn-dark-75 btn-block" onclick="edit()">Düzenle</button>
                    </div>
                    @endAuthority
                </div>
            </div>
        </div>
        <hr>
    </div>
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


    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        @Authority(62)
        <a onclick="edit()" class="dropdown-item cursor-pointer">
            <div class="row">
                <div class="col-xl-12">
                    <i class="fas fa-pen text-primary"></i><span class="ml-4">Düzenle</span>
                </div>
            </div>
        </a>
        @endAuthority
    </div>

@endsection

@section('page-styles')
    @include('pages.definition.components.style')
@stop

@section('page-script')
    @include('pages.definition.components.script')
@stop
