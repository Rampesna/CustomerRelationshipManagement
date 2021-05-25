@extends('layouts.master')
@section('title', $customer->title . ' - Dosyalar')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('mobile.customer.show.layouts.subheader')

    <input type="hidden" id="id_edit">

    <div class="row mt-15" id="filesCard">
        <div class="col-xl-2 mb-5 border-right border-light-dark" id="fileUploadArea">
            <div class="card h-100 flex-center bg-light-primary border-dashed p-8">
                <img src="https://preview.keenthemes.com/metronic8/demo1/assets/media/svg/files/upload.svg" class="mb-8 cursor-pointer" id="fileUploader" alt="" />
                <a class="font-weight-bolder text-dark-75 mb-2">Yeni Dosya</a>
                <div class="fs-7 fw-bold text-gray-400 mt-auto">Tıklayın veya Sürükleyin</div>
                <input type="file" id="uploadedFile" style="display: none">
            </div>
        </div>
    </div>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="context-menu" style="width: 300px">
        <a onclick="downloadFile()" class="dropdown-item cursor-pointer">
            <div class="row">
                <div class="col-xl-12">
                    <i class="fas fa-download text-primary"></i><span class="ml-4">İndir</span>
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

@endsection

@section('page-styles')
    @include('mobile.customer.show.file.components.style')
@stop

@section('page-script')
    @include('mobile.customer.show.file.components.script')
@stop
