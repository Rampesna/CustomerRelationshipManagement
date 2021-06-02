@extends('layouts.master')
@section('title', 'Anasayfa')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    <div class="row">
        <div class="col-xl-8">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card card-custom gutter-b" style="height: 200px;">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                <div class="mr-2">
                                    <h3 class="font-weight-bolder">Fırsatlar</h3>
                                    <div class="text-muted font-size-lg mt-2"><span id="opportunityDateSpan">--</span> | Fırsat Hedef Durumu</div>
                                </div>
                                <div class="font-weight-boldest font-size-h1 text-warning" id="opportunityCreatedAndTargetSpan">--/--</div>
                            </div>
                            <div class="pt-8">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="text-muted font-weight-bold mr-2">Hedef Oranı</div>
                                    <div class="text-muted font-weight-bold" id="opportunityRateSpan">--%</div>
                                </div>
                                <div class="progress bg-light-warning progress-xs">
                                    <div class="progress-bar bg-warning" role="progressbar" id="opportunityRateProgressBar" style="width: 0%;"  aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-custom gutter-b" style="height: 200px;">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between flex-grow-1">
                                <div class="mr-2">
                                    <h3 class="font-weight-bolder">Aktiviteler</h3>
                                    <div class="text-muted font-size-lg mt-2"><span id="activityDateSpan">--</span> | Aktivite Hedef Durumu</div>
                                </div>
                                <div class="font-weight-boldest font-size-h1 text-warning" id="activityCreatedAndTargetSpan">--/--</div>
                            </div>
                            <div class="pt-8">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="text-muted font-weight-bold mr-2">Hedef Oranı</div>
                                    <div class="text-muted font-weight-bold" id="activityRateSpan">--%</div>
                                </div>
                                <div class="progress bg-light-warning progress-xs">
                                    <div class="progress-bar bg-warning" role="progressbar" id="activityRateProgressBar" style="width: 0%;"  aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mt-n4">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header align-items-center border-0 mt-4">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="font-weight-bolder text-dark">Son Aktiviteler</span>
                            </h3>
                            <div class="card-toolbar">

                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="timeline timeline-5" id="lastActivities">
                                <div class="timeline-item align-items-start">
                                    <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg text-right pr-3">01.01.2021, 08:42</div>
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-success icon-xxl"></i>
                                    </div>
                                    <div class="timeline-content text-dark-50">Outlines of the recent activities that happened last weekend</div>
                                </div>
                                <div class="timeline-item align-items-start">
                                    <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg text-right pr-3">08:42</div>
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-success icon-xxl"></i>
                                    </div>
                                    <div class="timeline-content text-dark-50">Outlines of the recent activities that happened last weekend</div>
                                </div>
                                <div class="timeline-item align-items-start">
                                    <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg text-right pr-3">08:42</div>
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-success icon-xxl"></i>
                                    </div>
                                    <div class="timeline-content text-dark-50">Outlines of the recent activities that happened last weekend</div>
                                </div>
                                <div class="timeline-item align-items-start">
                                    <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg text-right pr-3">08:42</div>
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-success icon-xxl"></i>
                                    </div>
                                    <div class="timeline-content text-dark-50">Outlines of the recent activities that happened last weekend</div>
                                </div>
                                <div class="timeline-item align-items-start">
                                    <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg text-right pr-3">08:42</div>
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-success icon-xxl"></i>
                                    </div>
                                    <div class="timeline-content text-dark-50">Outlines of the recent activities that happened last weekend</div>
                                </div>
                                <div class="timeline-item align-items-start">
                                    <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg text-right pr-3">08:42</div>
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-success icon-xxl"></i>
                                    </div>
                                    <div class="timeline-content text-dark-50">Outlines of the recent activities that happened last weekend</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.dashboard.components.style')
@stop

@section('page-script')
    @include('pages.dashboard.components.script')
@stop
