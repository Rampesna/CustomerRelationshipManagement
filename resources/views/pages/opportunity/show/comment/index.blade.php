@extends('layouts.master')
@section('title', $opportunity->name . ' - Yorumlar')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.opportunity.show.layouts.subheader')

    @include('pages.opportunity.show.comment.components.create')
    @include('pages.opportunity.show.comment.components.edit')

    <div class="row mt-30">
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
    @include('pages.opportunity.show.comment.components.style')
@stop

@section('page-script')
    @include('pages.opportunity.show.comment.components.script')
@stop
