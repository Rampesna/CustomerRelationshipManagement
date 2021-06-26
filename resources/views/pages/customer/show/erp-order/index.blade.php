@extends('layouts.master')
@section('title', $customer->title . ' - Ticari Program Siparişleri')
@php(setlocale(LC_ALL, 'tr_TR.UTF-8'))
@php(setlocale(LC_TIME, 'Turkish'))

@section('content')

    @include('pages.customer.show.layouts.subheader')

    <div class="row mt-30">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="orders" class="table table-hover">
                        <thead>
                        <tr>
                            <th>Sipariş Tarihi</th>
                            <th>Teslim Tarihi</th>
                            <th>Evrak No</th>
                            <th>Sipariş Miktarı</th>
                            <th>Teslim Edilen Miktar</th>
                            <th>Kalan Miktar</th>
                            <th>Sipariş Tutarı</th>
                            <th>KDV</th>
                            <th>Açıklama</th>
                            <th>Stok Kodu</th>
                            <th>Stok Adı</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td data-sort="{{ date('Y-m-d', strtotime(str_replace('/', '-', $order['sip_tarih']))) }}">{{ date('d.m.Y', strtotime(str_replace('/', '-', $order['sip_tarih']))) }}</td>
                                <td data-sort="{{ date('Y-m-d', strtotime(str_replace('/', '-', $order['sip_teslim_tarih']))) }}">{{ date('d.m.Y', strtotime(str_replace('/', '-', $order['sip_teslim_tarih']))) }}</td>
                                <td>{{ $order['sip_evrak_no'] }}</td>
                                <td>{{ $order['sip_miktar'] }}</td>
                                <td>{{ $order['sip_teslim_miktar'] }}</td>
                                <td>{{ $order['KalanMiktar'] }}</td>
                                <td>{{ number_format($order['sip_tutar'], 2) }} TL</td>
                                <td>{{ number_format($order['sip_vergi'], 2) }} TL</td>
                                <td><textarea disabled rows="2" class="form-control">{!! $order['sip_aciklama'] !!}</textarea></td>
                                <td>{{ $order['sip_stok_kod'] }}</td>
                                <td>{{ $order['Stokisim'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sipariş Tarihi</th>
                            <th>Teslim Tarihi</th>
                            <th>Evrak No</th>
                            <th>Sipariş Miktarı</th>
                            <th>Teslim Edilen Miktar</th>
                            <th>Kalan Miktar</th>
                            <th>Sipariş Tutarı</th>
                            <th>KDV</th>
                            <th>Açıklama</th>
                            <th>Stok Kodu</th>
                            <th>Stok Adı</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    @include('pages.customer.show.erp-order.components.style')
@stop

@section('page-script')
    @include('pages.customer.show.erp-order.components.script')
@stop
