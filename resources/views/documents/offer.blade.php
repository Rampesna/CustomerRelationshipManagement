<html>
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teklif Bilgileri</title>
    <link rel="stylesheet" href="assets/others/assets/vendor/bootstrap/css/bootstrap.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1254"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <style>
        body {
            font-family: "dejavu sans", serif;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="row">
    <div class="col-6">
        <div class="row">
            <div class="col-12">
                <span class="font-weight-bolder" style="font-size: 11px">Müşteri: </span>
                <span style="font-size: 11px">{{ @$offer->relation_type == 'App\\Models\\Opportunity' ? @$offer->relation->name : (@$offer->relation_type == 'App\\Models\\Customer' ? $offer->relation->title : '') }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <span class="font-weight-bolder" style="font-size: 11px">Konu: </span>
                <span style="font-size: 11px">{{ @$offer->subject }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <span class="font-weight-bolder" style="font-size: 11px">Geçerlilik Tarihi: </span>
                <span style="font-size: 11px">{{ @date('d.m.Y', strtotime($offer->expiry_date)) }}</span>
            </div>
        </div>
    </div>
    <div class="col-12 text-right">
        <img src="assets/media/logos/bien.png" style="width: 160px; height: auto">
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table" style="font-size: 8px">
            <thead>
            <tr>
                <th>Mal/Hizmet</th>
                <th>Miktar</th>
                <th>Birim</th>
                <th>Birim Fiyat</th>
                <th>İskonto Oranı</th>
                <th>İskonto Tutarı</th>
                <th>Mal/Hizmet Tutarı</th>
                <th>KDV Oranı</th>
                <th>KDV Tutarı</th>
                <th>Genel Toplam</th>
            </tr>
            </thead>
            <tbody>
            @foreach($offer->items ?? [] as $item)
                <tr>
                    <td>{{ $item->stock->name }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->unit->name }}</td>
                    <td>{{ $item->unit_price . ' ' . @$offer->currency_type }}</td>
                    <td>{{ $item->discount_rate . '%' }}</td>
                    <td>{{ $item->discount_total . ' ' . @$offer->currency_type }}</td>
                    <td>{{ $item->subtotal . ' ' . @$offer->currency_type }}</td>
                    <td>{{ $item->vat_rate . '%' }}</td>
                    <td>{{ $item->vat_total . ' ' . @$offer->currency_type }}</td>
                    <td>{{ $item->grand_total . ' ' . @$offer->currency_type }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<hr style="margin-top: -15px">
<div class="row">
    <div class="col-12 text-right" style="font-size: 11px">
        <span class="font-weight-bolder">Mal/Hizmet Toplamı: </span><span style="font-size: 10px">{{ @number_format($offer->items()->sum('subtotal') ?? 0, 2) . ' ' . @$offer->currency_type }}</span>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12 text-right" style="font-size: 11px">
        <span class="font-weight-bolder">İskonto Toplamı: </span><span style="font-size: 10px">{{ @number_format($offer->items()->sum('discount_total') ?? 0, 2) . ' ' . @$offer->currency_type }}</span>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12 text-right" style="font-size: 11px">
        <span class="font-weight-bolder">KDV Toplamı: </span><span style="font-size: 10px">{{ @number_format($offer->items()->sum('vat_total') ?? 0, 2) . ' ' . @$offer->currency_type }}</span>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12 text-right" style="font-size: 11px">
        <span class="font-weight-bolder">Genel Toplam: </span><span style="font-size: 10px">{{ @number_format($offer->items()->sum('grand_total') ?? 0, 2) . ' ' . @$offer->currency_type }}</span>
    </div>
</div>
@if($offer->description && $offer->description != '')
    <hr>
    <div class="row" style="font-size: 11px;">
        <div class="col-12">
            <span class="font-weight-bolder">Açıklamalar: </span><br>
            <span>{!! $offer->description !!}</span>
        </div>
    </div>
@endif
@if(count($fixedOfferNotes) > 0)
    <hr>
    @foreach($fixedOfferNotes as $note)
        <div class="row" style="font-size: 11px;">
            <div class="col-12">
                <span class="font-weight-bolder">NOT: </span><span>{!! $note->name !!}</span>
            </div>
        </div>
    @endforeach
@endif
</body>
</html>
