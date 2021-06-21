<html>
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fiyat Listesi</title>
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
                <span class="font-weight-bolder" style="font-size: 11px">Fiyat Listesi Adı: </span>
                <span style="font-size: 11px">{{ @$priceList->name }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <span class="font-weight-bolder" style="font-size: 11px">Başlangıç Tarihi: </span>
                <span style="font-size: 11px">{{ @date('d.m.Y', strtotime($priceList->start_date)) }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <span class="font-weight-bolder" style="font-size: 11px">Bitiş Tarihi: </span>
                <span style="font-size: 11px">{{ @date('d.m.Y', strtotime($priceList->end_date)) }}</span>
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
                <th>Birim Fiyat</th>
                <th>KDV Oranı</th>
                <th>Döviz Türü</th>
            </tr>
            </thead>
            <tbody>
            @foreach($priceList->items ?? [] as $item)
                <tr>
                    <td>{{ @$item->stock->name }}</td>
                    <td>{{ @$item->unit_price }}</td>
                    <td>{{ @$item->vat_rate . '%' }}</td>
                    <td>{{ @$item->currency_type }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<hr style="margin-top: -15px">
@if($priceList->description && $priceList->description != '')
    <hr>
    <div class="row" style="font-size: 11px;">
        <div class="col-12">
            <span class="font-weight-bolder">Açıklamalar: </span><br>
            <span>{!! $priceList->description !!}</span>
        </div>
    </div>
@endif
</body>
</html>
