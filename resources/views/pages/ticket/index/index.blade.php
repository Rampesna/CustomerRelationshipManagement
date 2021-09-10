@extends('layouts.master')
@section('title', 'Destek Talepleri')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.ticket.index.rightbars.create')

    <div id="isMobile">
        <div class="row">
            <div class="col-4">
                <button class="btn btn-primary btn-block" onclick="create()">Yeni Oluştur</button>
            </div>
            <div class="col-4">
                <button class="btn btn-dark-75 btn-block" onclick="show()">İncele</button>
            </div>
        </div>
        <hr>
    </div>

    <input type="hidden" id="statusSelector" value="0">
    <input type="hidden" id="id_edit">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <a onclick="setStatus(0)" class="col border-right pb-4 pt-4 text-dark-75 cursor-pointer">
                            <i class="fas fa-ticket-alt fa-2x text-danger"></i><br>
                            <label class="mb-0 mr-5 cursor-pointer">Tüm Destek Talepleri</label>
                            <h4 class="font-30 font-weight-bold text-col-blue" style="font-size: 30px"></h4>
                        </a>
                        <a onclick="setStatus(1)" class="col border-right pb-4 pt-4 text-dark-75 cursor-pointer">
                            <i class="fas fa-clock fa-2x text-warning"></i><br>
                            <label class="mb-0 mr-5 cursor-pointer">Cevap Bekleyen</label>
                            <h4 class="font-30 font-weight-bold text-col-blue" style="font-size: 30px"></h4>
                        </a>
                        <a onclick="setStatus(2)" class="col border-right pb-4 pt-4 text-dark-75 cursor-pointer">
                            <i class="fab fa-font-awesome-flag fa-2x text-primary"></i><br>
                            <label class="mb-0 mr-5 cursor-pointer">Cevaplanan</label>
                            <h4 class="font-30 font-weight-bold text-col-blue" style="font-size: 30px"></h4>
                        </a>
                        <a onclick="setStatus(3)" class="col border-right pb-4 pt-4 text-dark-75 cursor-pointer">
                            <i class="fas fa-check-circle fa-2x text-success"></i><br>
                            <label class="mb-0 mr-5 cursor-pointer">Tamamlanan</label>
                            <h4 class="font-30 font-weight-bold text-col-blue" style="font-size: 30px"></h4>
                        </a>
                        <a onclick="setStatus(4)" class="col pb-4 pt-4 text-dark-75 cursor-pointer">
                            <i class="fas fa-times-circle fa-2x text-danger"></i><br>
                            <label class="mb-0 mr-5 cursor-pointer">İptal Edilen</label>
                            <h4 class="font-30 font-weight-bold text-col-blue" style="font-size: 30px"></h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-12">
            <div class="card" id="ticketsCard">
                <div class="card-body">
                    <table class="table" id="tickets">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Başlık</th>
                            <th>Durum</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Başlık</th>
                            <th>Durum</th>
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
            <a onclick="show()" class="dropdown-item cursor-pointer">
                <div class="row">
                    <div class="col-xl-12">
                        <i class="fas fa-eye text-primary"></i><span class="ml-4">İncele</span>
                    </div>
                </div>
            </a>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.ticket.index.components.style')
@stop

@section('page-script')
    @include('pages.ticket.index.components.script')
@stop
