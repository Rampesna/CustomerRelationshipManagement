@extends('layouts.master')
@section('title', $customer->title . ' - Finansal Hareketler')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.customer.show.layouts.subheader')

    <div class="row mt-30">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="finances" class="table table-hover">
                        <thead>
                        <tr>
                            <th>Tarih</th>
                            <th>Evrak No</th>
                            <th>Belge No</th>
                            <th>İşlem Türü</th>
                            <th>Açıklama</th>
                            <th class="text-right">Tutar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($finances as $finance)
                            <tr>
                                <td data-sort="{{ date('Y-m-d', strtotime($finance['cha_tarihi'])) }}">{{ date('d.m.Y', strtotime($finance['cha_tarihi'])) }}</td>
                                <td>{{ $finance['cha_evrak_no'] }}</td>
                                <td>{{ $finance['cha_belge_no'] }}</td>
                                <td>{{ $finance['CHCinsIsim'] }}</td>
                                <td>{{ $finance['cha_aciklama'] }}</td>
                                <td data-sort="{{ round($finance['cha_meblag']) }}" class="text-right">{{ number_format($finance['cha_meblag'],2,',','.') }} TL</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Tarih</th>
                            <th>Evrak No</th>
                            <th>Belge No</th>
                            <th>İşlem Türü</th>
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
    @include('pages.customer.show.finance-activity.components.style')
@stop

@section('page-script')
    @include('pages.customer.show.finance-activity.components.script')
@stop
