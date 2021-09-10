@extends('layouts.master')
@section('title', $ticket->subject ?? '')

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="mr-3">
                                            <div class="d-flex align-items-center mr-3">
                                                <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $ticket->subject }}</a>
                                            </div>
                                            <div class="d-flex flex-wrap my-2">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                                        <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">{!! $ticket->description !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card card-custom">
                                        <div class="card-header h-auto py-4">
                                            <div class="card-title">
                                                <h3 class="card-label">
                                                    Detaylar
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="card-body py-4">
                                            <div class="form-group row my-2">
                                                <label class="col-6 col-form-label">Oluşturan:</label>
                                                <div class="col-6 text-right">
                                            <span class="form-control-plaintext font-weight-bolder">
                                                {{ @$ticket->user->name }}
                                            </span>
                                                </div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <label class="col-6 col-form-label">Oluşturulma Tarihi:</label>
                                                <div class="col-6 text-right">
                                            <span class="form-control-plaintext font-weight-bolder">
                                                {{ @date($ticket->created_at) }}
                                            </span>
                                                </div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <label class="col-6 col-form-label">Durum:</label>
                                                <div class="col-6 text-right">
                                            <span class="form-control-plaintext font-weight-bolder">
                                                <span class="label label-light-{{ $ticket->status->color }} label-inline font-weight-bolder mr-1">
                                                    {{ @$ticket->status->name }}
                                                </span>
                                            </span>
                                                </div>
                                            </div>
                                            <div class="form-group row my-2">
                                                <label class="col-6 col-form-label"><i class="fa fa-paperclip mr-2"></i>Ekler: </label>
                                                <div class="col-6 text-right">
                                                    @foreach($ticket->files as $file)
                                                        <a href="{{ asset($file->path . $file->name) }}" target="_blank" class="fa fa-file cursor-pointer mt-4 mr-2" title="{{ $file->name }}"></a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(auth()->user()->manager() == 1)
                                @if($ticket->status_id == 1 || $ticket->status_id == 2)
                                    <hr>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <button class="btn btn-success btn-block" onclick="setTicketStatus(3)">Onayla/Sonlandır</button>
                                        </div>
                                        <div class="col-xl-6">
                                            <button class="btn btn-danger btn-block" onclick="setTicketStatus(4)">İptal Et</button>
                                        </div>
                                    </div>
                                @else
                                    <hr>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <button class="btn btn-warning btn-block" onclick="setTicketStatus(1)">Talebi Tekrar Aktif Et</button>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-pane active" id="kt_apps_contacts_view_tab_1" role="tabpanel">
                                        <div class="container">
                                            @if($ticket->status_id == 1 || $ticket->status_id == 2)
                                                <form action="{{ route('ticket-message.save') }}" method="post" class="form" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <span class="mr-2"><i class="fa fa-paperclip mr-2"></i>Ekler: </span>
                                                            <input type="file" name="images[]" multiple>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                                    <input type="hidden" name="status_id" value="2">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="form-group">
                                                                <label style="width: 100%">
                                                                    <textarea class="form-control form-control-lg form-control-solid" id="message" name="message" rows="3" placeholder="Mesajınız..." required></textarea>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-12 text-right mt-n5">
                                                            <button type="submit" class="btn btn-light-success font-weight-bold">Yanıtla</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="separator separator-dashed my-10"></div>
                                            @endif
                                            <div class="timeline timeline-3">
                                                <div class="timeline-items">
                                                    @foreach($ticket->messages as $message)
                                                    <div class="timeline-item">
                                                        <div class="timeline-media">
                                                            <img alt="Pic" src="{{ $message->user->image ? asset($message->user->image) : asset('assets/media/favicon/favicon.png') }}" />
                                                        </div>
                                                        <div class="timeline-content">
                                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                                <div class="mr-2">
                                                                    <a class="text-dark-75 text-hover-primary font-weight-bold cursor-pointer">{{ $message->user->name }}</a>
                                                                    <span class="text-muted ml-2">{{ strftime('%d.%m.%Y, %H:%M', strtotime($message->created_at)) }}</span>
                                                                </div>
                                                            </div>
                                                            <p class="p-0">{{ $message->message }}</p>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <i class="fa fa-paperclip mr-2"></i>Ekler:
                                                                    @foreach($message->files as $file)
                                                                        <a download href="{{ asset($file->path . $file->name) }}" target="_blank" class="fa fa-file cursor-pointer mt-4 ml-2" title="{{ $file->name }}"></a>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    @include('pages.ticket.show.components.style')
@stop

@section('page-script')
    @include('pages.ticket.show.components.script')
@stop
