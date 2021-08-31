@extends('layouts.master')
@section('title', 'Destek Talepleri')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <div id="isMobile">
        <div class="row">
            <div class="col-4">
                @Authority(4)
                <button class="btn btn-primary btn-block" onclick="create()">Yeni Oluştur</button>
                @endAuthority
            </div>
            <div class="col-4">
                <div class="row">
                    @Authority(5)
                    <div class="col-12">
                        <button class="btn btn-dark-75 btn-block" onclick="edit()">Düzenle</button>
                    </div>
                    @endAuthority
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    @Authority(6)
                    <div class="col-12">
                        <button class="btn btn-danger btn-block" onclick="drop()">Sil</button>
                    </div>
                    @endAuthority
                </div>
            </div>
        </div>
        <hr>
    </div>
    <hr>
    <div class="row mt-15">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <a href="http://ots.ayssoft.com/project-management/project/14/tickets" class="col-xl-3 border-right pb-4 pt-4 text-dark-75">
                            <i class="fas fa-ticket-alt fa-2x text-danger"></i><br>
                            <label class="mb-0 mr-5 cursor-pointer">Tüm Destek Talepleri</label>
                            <h4 class="font-30 font-weight-bold text-col-blue" style="font-size: 30px">0</h4>
                        </a>
                        <a href="http://ots.ayssoft.com/project-management/project/14/tickets/1" class="col-xl-3 border-right pb-4 pt-4 text-dark-75">
                            <i class="fas fa-clock fa-2x text-warning"></i><br>
                            <label class="mb-0 mr-5 cursor-pointer">Cevap Bekleyen</label>
                            <h4 class="font-30 font-weight-bold text-col-blue" style="font-size: 30px">0</h4>
                        </a>
                        <a href="http://ots.ayssoft.com/project-management/project/14/tickets/2" class="col-xl-3 border-right pb-4 pt-4 text-dark-75">
                            <i class="fab fa-font-awesome-flag fa-2x text-primary"></i><br>
                            <label class="mb-0 mr-5 cursor-pointer">Cevaplanan</label>
                            <h4 class="font-30 font-weight-bold text-col-blue" style="font-size: 30px">0</h4>
                        </a>
                        <a href="http://ots.ayssoft.com/project-management/project/14/tickets/3" class="col-xl-3 pb-4 pt-4 text-dark-75">
                            <i class="fas fa-check-circle fa-2x text-success"></i><br>
                            <label class="mb-0 mr-5 cursor-pointer">Tamamlanan</label>
                            <h4 class="font-30 font-weight-bold text-col-blue" style="font-size: 30px">0</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="tickets">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Başlık</th>
                            <th>Bağlantı</th>
                            <th>Oluşturulma Tarihi</th>
                            <th>Öncelik</th>
                            <th>Son İşlem</th>
                            <th>Durum</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Başlık</th>
                            <th>Bağlantı</th>
                            <th>Oluşturulma Tarihi</th>
                            <th>Öncelik</th>
                            <th>Son İşlem</th>
                            <th>Durum</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.ticket.index.components.style')
@stop

@section('page-script')
    @include('pages.ticket.index.components.script')
@stop
