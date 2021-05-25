@extends('layouts.master')
@section('title', 'Yorumlar')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('mobile.customer.show.layouts.subheader')

    @include('mobile.customer.show.comment.modals.create')
    @include('mobile.customer.show.comment.modals.edit')

    <div class="row">
        <div class="col-6">
            <button class="btn btn-primary" onclick="create()">Yeni Oluştur</button>
        </div>
        <div class="col-6 text-right">
            <div class="row">
                <div class="col-12">
                    <button id="EditButton" class="btn btn-dark-75" onclick="edit()" style="display: none">Düzenle</button>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row mt-15">
        <div class="col-xl-12">
            <div class="card" id="commentsCard">
                <div class="card-body">
                    <table class="table" id="comments">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Yorumu Yapan</th>
                            <th>Yorum</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Yorumu Yapan</th>
                            <th>Yorum</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('mobile.customer.show.comment.components.style')
@stop

@section('page-script')
    @include('mobile.customer.show.comment.components.script')
@stop
