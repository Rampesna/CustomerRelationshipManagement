@extends('layouts.master')
@section('title', 'Yardımcı Videolar')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        <a href="{{ route('video.settings') }}" class="dropdown-item cursor-pointer">
            <div class="row">
                <div class="col-xl-12">
                    <i class="far fa-dot-circle text-primary"></i><span class="ml-4">Videoları Düzenle</span>
                </div>
            </div>
        </a>
    </div>

@endsection

@section('page-styles')
    @include('pages.video.index.components.style')
@stop

@section('page-script')
    @include('pages.video.index.components.script')
@stop
