@extends('mobile.layouts.master')
@section('title', 'Fırsat Detayları')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('mobile.opportunity.show.layouts.subheader')
    @include('mobile.opportunity.show.activity.components.create')
    @include('mobile.opportunity.show.activity.components.edit')

    <div class="row mt-15">
        <div class="col-xl-12">
            <div class="card" id="activitiesCard">
                <div class="card-body">
                    <table class="table" id="activities">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Konu</th>
                            <th>Firma</th>
                            <th>Temsilci</th>
                            <th>Başlangıç Tarihi</th>
                            <th>Bitiş Tarihi</th>
                            <th>Görüşme Nedeni</th>
                            <th>Öncelik</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Konu</th>
                            <th>Firma</th>
                            <th>Temsilci</th>
                            <th>Başlangıç Tarihi</th>
                            <th>Bitiş Tarihi</th>
                            <th>Görüşme Nedeni</th>
                            <th>Öncelik</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('mobile.opportunity.show.activity.components.style')
@stop

@section('page-script')
    @include('mobile.opportunity.show.activity.components.script')
@stop
