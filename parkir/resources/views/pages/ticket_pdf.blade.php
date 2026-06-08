<!DOCTYPE html>
<html>
<head>
    <title>Tiket Parkir - {{ $no_tiket }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px 30px;
            text-align: center;
            color: #000000;
        }
        .header {
            font-size: 13px;
            line-height: 1.35;
            margin-bottom: 20px;
        }
        .header-title {
            font-size: 16px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 4px;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
            margin: 0 0 10px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info {
            font-size: 16px;
            font-weight: bold;
            margin: 5px 0;
        }
        .details {
            font-size: 14px;
            font-weight: bold;
            margin: 35px 0;
            line-height: 1.5;
        }
        .footer {
            font-size: 11px;
            font-weight: bold;
            margin-top: 20px;
            line-height: 1.4;
        }
    </style>
</head>
<body>
    <div class="header">
        <span class="header-title">SIJA PARKING</span><br>
        Jl. Raya Karadenan No.7, Karadenan,<br>
        Kec. Cibinong, Kabupaten Bogor, Jawa<br>
        Barat 16111
    </div>
    
    <hr style="border: 0; border-top: 1px dashed #cccccc; margin: 25px 0;">
    
    <div class="title">TIKET PARKIR</div>
    <div class="info">{{ $location_name }}</div>
    <div class="info">{{ $vehicle_type_label }}</div>
    
    <div class="details">
        No Tiket : {{ $no_tiket }}<br>
        Tanggal : {{ $tanggal }}
    </div>
    
    <hr style="border: 0; border-top: 1px dashed #cccccc; margin: 25px 0;">
    
    <div class="footer">
        JANGAN MENINGGALKAN TIKET DAN BARANG<br>
        BERHARGA DI DALAM KENDARAAN
    </div>
</body>
</html>
