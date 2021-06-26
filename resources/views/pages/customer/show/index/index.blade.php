@extends('layouts.master')
@section('title', $customer->title . ' - Detaylar')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))

@section('content')

    @include('pages.customer.show.layouts.subheader')
    @include('pages.customer.show.index.modals.edit')

    <div class="row mt-30">
        <div class="col-xl-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="mt-3 mb-0">{{ @$customer->title ?? '--' }}</h6>
                        @Authority(26)
                        <button id="editCustomer" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#EditModal">Düzenle</button>
                        @endAuthority
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>Firma</div>
                        <div>{{ @$customer->company->name ?? '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Vergi Dairesi</div>
                        <div>{{ @$customer->tax_office ?? '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Vergi Numarası</div>
                        <div>{{ @$customer->tax_number ?? '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>E-posta Adresi</div>
                        <div>{{ @$customer->email ?? '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Telefon Numarası</div>
                        <div>+{{ @$customer->country->code ?? '' }} {{ @$customer->phone_number ?? '' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Kuruluş Tarihi</div>
                        <div>{{ @$customer->foundation_date ?? '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Website Adresi</div>
                        <div>{{ @$customer->website ?? '--' }}</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>Ülke</div>
                        <div>{{ @$customer->country->name ?? '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Şehir</div>
                        <div>{{ @$customer->province->name ?? '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>İlçe</div>
                        <div>{{ @$customer->district->name ?? '--' }}</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>Sınıf</div>
                        <div>{{ @$customer->class->name ?? '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Tür</div>
                        <div>{{ @$customer->type->name ?? '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Referans</div>
                        <div>{{ @$customer->reference->name ?? '--' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.customer.show.index.components.style')
@stop

@section('page-script')
    @include('pages.customer.show.index.components.script')
@stop
