@extends('layouts.master')
@section('title', $activity->subject . ' - Detayları')
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.activity.show.layouts.subheader')

    <div class="row mt-30">
        <div class="col-xl-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="mt-3 mb-0">{{ @$activity->subject ?? '--' }}</h6>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>Firma</div>
                        <div>{{ @$activity->company->name ?? '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Temsilci</div>
                        <div>{{ @$activity->user->name ?? '--' }}</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>Bağlantı Türü</div>
                        <div>{{ @$activity->relation_type == 'App\\Models\\Opportuinty' ? 'Fırsat' : (@$activity->relation_type == 'App\\Models\\Customer' ? 'Müşteri' : '--') }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Bağlantı</div>
                        <div>{{ @$activity->relation->name ?? $activity->relation->title }}</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>Başlangıç Tarihi</div>
                        <div>{{ @$activity->start_date ? @date('d.m.Y', strtotime($activity->start_date)) : '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Bitiş Tarihi</div>
                        <div>{{ @$activity->end_date ? @date('d.m.Y', strtotime($activity->end_date)) : '--' }}</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>Görüşme Nedeni</div>
                        <div>{{ @$activity->meetReason ? $activity->meetReason->name : '--' }}</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Öncelik Durumu</div>
                        <div>{{ @$activity->priority ? $activity->priority->name : '--' }}</div>
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
                    <p>{!! @$activity->description !!}</p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.activity.show.index.components.style')
@stop

@section('page-script')
    @include('pages.activity.show.index.components.script')
@stop
