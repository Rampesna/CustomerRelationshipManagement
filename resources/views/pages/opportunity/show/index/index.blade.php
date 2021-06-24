@extends('layouts.master')
@section('title', 'Fırsat Detayları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
{{--@php(setlocale(LC_TIME, 'Turkish'))--}}

@section('content')

    @include('pages.opportunity.show.layouts.subheader')
    @include('pages.opportunity.show.index.modals.edit')

    <div class="row mt-15">
        <div class="col-xl-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="mt-3 mb-0">{{ @$opportunity->name ?? '--' }}</h6>
                        @Authority(15)
                        <button id="editOpportunity" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#EditModal" onclick="edit()">Düzenle</button>
                        @endAuthority
                    </div>
                    <span>{{ $opportunity->date ? date('d.m.Y', strtotime($opportunity->date)) : '__.__.____' }}</span>
                    <br>
                    <span>{{ @$opportunity->customer->title ?? '--' }}</span>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>Firma</div>
                        <div>{{ @$opportunity->company->name ?? '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Temsilci</div>
                        <div>{{ @$opportunity->user->name ?? '--' }}</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>E-posta Adresi</div>
                        <div>{{ @$opportunity->email ?? '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Telefon Numarası</div>
                        <div>{{ @$opportunity->phone_number ?? '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Website Adresi</div>
                        <div>{{ @$opportunity->website ?? '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Firma Kuruluş Tarihi</div>
                        <div>{{ @$opportunity->foundation_date ? date('d.m.Y', strtotime($opportunity->foundation_date)) : '--' }}</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>Yetkili Adı</div>
                        <div>{{ @$opportunity->manager_name ?? '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Yetkili E-posta Adresi</div>
                        <div>{{ @$opportunity->manager_email ?? '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Yetkili Telefon Numarası</div>
                        <div>{{ @$opportunity->manager_phone_number ?? '--' }}</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>Tutar</div>
                        <div>{{ @$opportunity->price ?? '--'}} {{ $opportunity->currency ?? '' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Öncelik</div>
                        <div>{{ @$opportunity->priority_id ? @$opportunity->priority->name : '--'}}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Erişim Türü</div>
                        <div>{{ @$opportunity->access_type_id ? @$opportunity->accessType->name : '--'}}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Yerli / Yabancı</div>
                        <div>{{ @$opportunity->domestic == 0 ? 'Yerli' : 'Yabancı' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Ülke</div>
                        <div>{{ @$opportunity->country_id ? $opportunity->country->name : '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Şehir</div>
                        <div>{{ @$opportunity->province_id ? $opportunity->province->name : '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>İlçe</div>
                        <div>{{ @$opportunity->district_id ? $opportunity->district->name : '--' }}</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>Tahmini Sonuçlanma</div>
                        <div>{{ @$opportunity->estimated_result ?? '--' }} {{ @$opportunity->estimated_result_type_id ? @$opportunity->estimatedResultType->name : '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Kapasite</div>
                        <div>{{ @$opportunity->capacity ?? '--' }} {{ @$opportunity->capacity_type_id ? @$opportunity->capacityType->name : '--' }}</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>Fırsat Durumu</div>
                        <div>{{ @$opportunity->status_id ? @$opportunity->status->name : '--' }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h6>Açıklamalar</h6>
                </div>
                <div class="card-body">
                    <p>{!! $opportunity->description !!}</p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.opportunity.show.index.components.style')
@stop

@section('page-script')
    @include('pages.opportunity.show.index.components.script')
@stop
