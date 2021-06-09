@extends('layouts.master')
@section('title', 'Müşteriler')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.customer.show.layouts.subheader')

    <div class="row mt-10">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="purchases" class="table table-hover display nowrap">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Tarih</th>
                            <th>Evrak No</th>
                            <th>Belge No</th>
                            <th>Fatura Türü</th>
                            <th>Açıklama</th>
                            <th class="text-right">Tutar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchases as $purchase)
                            <tr data-child-value="{{ json_encode($purchase['childRecords']) }}">
                                <td class="details-control"></td>
                                <td data-sort="{{ date('Y-m-d', strtotime(str_replace('.','-',$purchase['cha_tarihi']))) }}">{{ date('d.m.Y', strtotime(str_replace('.','-',$purchase['cha_tarihi']))) }}</td>
                                <td>{{ $purchase['cha_evrak_no'] }}</td>
                                <td>{{ $purchase['cha_belge_no'] }}</td>
                                <td>{{ $purchase['CHCinsIsim'] }}</td>
                                <td><textarea disabled rows="2" class="form-control">{!! $purchase['cha_aciklama'] !!}</textarea></td>
                                <td class="text-right">{{ number_format(str_replace(',','.',$purchase['cha_meblag']),2,'.',',') }} TL</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th>Tarih</th>
                            <th>Evrak No</th>
                            <th>Belge No</th>
                            <th>Fatura Türü</th>
                            <th>Açıklama</th>
                            <th class="text-right">Tutar</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.customer.show.purchase.components.style')
@stop

@section('page-script')
    @include('pages.customer.show.purchase.components.script')
@stop
