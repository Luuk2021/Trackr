<!DOCTYPE html>
<html>
<head>
    <title>Trackr</title>
    <style>
        * {
            font-family: sans-serif
        }

        p {
            margin: 5px 0;
        }

        h6 {
            display: inline;
            text-transform: uppercase
        }
    </style>
    <style media="print">
        @page {
            size: auto;
            margin: 0;
        }
    </style>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
@foreach($packages as $package)
    @if($packages[0] != $package)
        <div class="page-break"></div>
    @endif
    <body style="display: flex;flex-direction: column;height: 90%;box-sizing: border-box;padding: 40px">
    <div style="display: flex;justify-content: space-between">
        <div>
            <h5>FROM:</h5>
            {{ $package->shop->name }}<br>
            {{ $package->shop->streetname . ' ' . $package->shop->housenumber . ', ' . $package->shop->zipcode}}<br>
            {{ $package->shop->city }}
        </div>
        <div style='text-align:right'>
            <h6>TRANSPORTER: #NAME#</h6><br>
            <h6>TRACKING #: {{ $package->pairing_code }}</h6><br>
            <div><img
                    src="data:image/png;base64, {!! base64_encode(QrCode::size(200)->generate($package->pairing_code)) !!} ">
            </div>
        </div>
    </div>
    <div>
        <h3>To: {{ $package->firstname . ' ' . $package->lastname}}</h3>
        <h3>{{ $package->streetname . ' ' . $package->housenumber . ', ' . $package->zipcode}}<br></h3>
        {{ $package->city }}
    </div>
    </body>
@endforeach
</html>
