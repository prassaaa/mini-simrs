<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Rekam Medis Gigi - {{ $odontogram->kunjungan->pasien->nama_pasien }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            line-height: 1.4;
            color: #333;
        }

        .container {
            padding: 20px;
        }

        /* Header / Kop Surat */
        .header {
            text-align: center;
            border-bottom: 3px double #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .header h2 {
            font-size: 14px;
            font-weight: normal;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 9px;
            color: #666;
        }

        /* Title */
        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .title h3 {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 1px solid #333;
            display: inline-block;
            padding-bottom: 5px;
        }

        /* Info Pasien */
        .info-section {
            margin-bottom: 15px;
        }

        .info-section h4 {
            font-size: 11px;
            font-weight: bold;
            background-color: #f0f0f0;
            padding: 5px 10px;
            margin-bottom: 10px;
            border-left: 3px solid #333;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 4px 8px;
            vertical-align: top;
        }

        .info-table .label {
            width: 150px;
            font-weight: bold;
            color: #555;
        }

        .info-table .colon {
            width: 10px;
        }

        /* Odontogram Chart */
        .odontogram-section {
            margin-bottom: 15px;
        }

        .odontogram-chart {
            width: 100%;
            text-align: center;
            margin: 10px 0;
        }

        .teeth-row {
            display: inline-block;
            margin: 5px 0;
        }

        .tooth {
            display: inline-block;
            width: 30px;
            text-align: center;
            margin: 0 2px;
            vertical-align: top;
        }

        .tooth-number {
            font-size: 8px;
            font-weight: bold;
        }

        .tooth-img {
            width: 25px;
            height: 25px;
        }

        .quadrant-label {
            font-size: 9px;
            font-weight: bold;
            color: #666;
            margin: 5px 0;
        }

        .teeth-separator {
            display: inline-block;
            width: 20px;
            border-left: 1px solid #999;
            height: 40px;
            vertical-align: middle;
        }

        /* Odontogram Chart Visual */
        .odontogram-visual {
            width: 100%;
            margin: 15px 0;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #fafafa;
        }

        .odontogram-visual-title {
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .teeth-chart {
            width: 100%;
        }

        .teeth-chart-row {
            text-align: center;
            margin: 5px 0;
        }

        .teeth-chart-row table {
            margin: 0 auto;
            border-collapse: collapse;
        }

        .teeth-chart-row td {
            padding: 2px;
            text-align: center;
            vertical-align: bottom;
        }

        .teeth-chart-row.bottom-row td {
            vertical-align: top;
        }

        .tooth-cell {
            width: 28px;
            text-align: center;
        }

        .tooth-cell img {
            width: 22px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .tooth-cell .tooth-num {
            font-size: 7px;
            font-weight: bold;
            color: #333;
        }

        .chart-divider {
            width: 100%;
            border-top: 2px solid #333;
            margin: 8px 0;
        }

        .chart-divider-vertical {
            width: 2px;
            background-color: #333;
        }

        .row-label {
            font-size: 8px;
            font-weight: bold;
            color: #666;
            padding: 0 5px;
        }

        .dinding-indicator {
            display: inline-block;
            margin-top: 2px;
        }

        .dinding-box {
            width: 16px;
            height: 16px;
            border: 1px solid #999;
            margin: 0 auto;
            position: relative;
        }

        .dinding-top, .dinding-bottom {
            position: absolute;
            left: 2px;
            right: 2px;
            height: 3px;
        }

        .dinding-top { top: 1px; }
        .dinding-bottom { bottom: 1px; }

        .dinding-left, .dinding-right {
            position: absolute;
            top: 2px;
            bottom: 2px;
            width: 3px;
        }

        .dinding-left { left: 1px; }
        .dinding-right { right: 1px; }

        .dinding-center {
            position: absolute;
            top: 4px;
            bottom: 4px;
            left: 4px;
            right: 4px;
        }

        .dinding-normal { background-color: #38bdf8; }
        .dinding-bermasalah { background-color: #f97316; }

        /* Kondisi Gigi Table */
        .kondisi-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .kondisi-table th,
        .kondisi-table td {
            border: 1px solid #ddd;
            padding: 5px 8px;
            text-align: left;
        }

        .kondisi-table th {
            background-color: #f5f5f5;
            font-weight: bold;
            font-size: 9px;
        }

        .kondisi-table td {
            font-size: 9px;
        }

        /* Pemeriksaan Lainnya */
        .pemeriksaan-grid {
            display: table;
            width: 100%;
        }

        .pemeriksaan-row {
            display: table-row;
        }

        .pemeriksaan-cell {
            display: table-cell;
            width: 33.33%;
            padding: 5px;
            vertical-align: top;
        }

        .pemeriksaan-item {
            margin-bottom: 8px;
        }

        .pemeriksaan-item .label {
            font-weight: bold;
            color: #555;
            font-size: 9px;
        }

        .pemeriksaan-item .value {
            font-size: 10px;
        }

        /* DMF Status */
        .dmf-section {
            text-align: center;
            margin: 15px 0;
        }

        .dmf-box {
            display: inline-block;
            border: 1px solid #333;
            padding: 10px 20px;
            margin: 0 10px;
            text-align: center;
        }

        .dmf-box .number {
            font-size: 24px;
            font-weight: bold;
        }

        .dmf-box .label {
            font-size: 9px;
            color: #666;
        }

        /* Diagnosa & Planning */
        .diagnosa-section {
            margin-bottom: 15px;
        }

        .diagnosa-item {
            margin-bottom: 10px;
        }

        .diagnosa-item .label {
            font-weight: bold;
            font-size: 10px;
            margin-bottom: 3px;
        }

        .diagnosa-item .content {
            border: 1px solid #ddd;
            padding: 8px;
            min-height: 40px;
            background-color: #fafafa;
        }

        /* Footer / Tanda Tangan */
        .footer {
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .signature-section {
            width: 100%;
            display: table;
        }

        .signature-box {
            display: table-cell;
            width: 50%;
            text-align: center;
            padding: 10px;
        }

        .signature-box .date {
            margin-bottom: 60px;
        }

        .signature-box .name {
            font-weight: bold;
            border-top: 1px solid #333;
            display: inline-block;
            padding-top: 5px;
            min-width: 150px;
        }

        .signature-box .title-sign {
            font-size: 9px;
            color: #666;
        }

        /* Page Break */
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header / Kop Surat RS -->
        <div class="header">
            <h1>RUMAH SAKIT MINI SIMRS</h1>
            <h2>Klinik Gigi dan Mulut</h2>
            <p>Jl. Kesehatan No. 123, Kota Sehat, Indonesia | Telp: (021) 1234567 | Email: info@minisimrs.com</p>
        </div>

        <!-- Title -->
        <div class="title">
            <h3>Rekam Medis Odontogram</h3>
        </div>

        <!-- Info Pasien -->
        <div class="info-section">
            <h4>Informasi Pasien & Kunjungan</h4>
            <table class="info-table">
                <tr>
                    <td class="label">No. Rekam Medis</td>
                    <td class="colon">:</td>
                    <td>{{ $odontogram->kunjungan->no_rm }}</td>
                    <td class="label">No. Registrasi</td>
                    <td class="colon">:</td>
                    <td>{{ $odontogram->kunjungan->no_registrasi_kunjungan }}</td>
                </tr>
                <tr>
                    <td class="label">Nama Pasien</td>
                    <td class="colon">:</td>
                    <td>{{ $odontogram->kunjungan->pasien->nama_pasien }}</td>
                    <td class="label">Tanggal Pemeriksaan</td>
                    <td class="colon">:</td>
                    <td>{{ $odontogram->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <td class="label">Jenis Kelamin</td>
                    <td class="colon">:</td>
                    <td>{{ $odontogram->kunjungan->pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td class="label">Dokter Pemeriksa</td>
                    <td class="colon">:</td>
                    <td>{{ $odontogram->kunjungan->dokter->nama_dokter ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Lahir</td>
                    <td class="colon">:</td>
                    <td>{{ $odontogram->kunjungan->pasien->tanggal_lahir ? \Carbon\Carbon::parse($odontogram->kunjungan->pasien->tanggal_lahir)->format('d/m/Y') : '-' }}</td>
                    <td class="label">Poli</td>
                    <td class="colon">:</td>
                    <td>{{ $odontogram->kunjungan->poliRelation->nama_poli ?? '-' }}</td>
                </tr>
            </table>
        </div>

        <!-- Pemeriksaan Ekstra & Intra Oral -->
        @if($odontogram->pemeriksaan_ekstra_oral || $odontogram->pemeriksaan_intra_oral)
        <div class="info-section">
            <h4>Pemeriksaan Fisik</h4>
            <table class="info-table">
                @if($odontogram->pemeriksaan_ekstra_oral)
                <tr>
                    <td class="label">Pemeriksaan Ekstra Oral</td>
                    <td class="colon">:</td>
                    <td colspan="4">{{ $odontogram->pemeriksaan_ekstra_oral }}</td>
                </tr>
                @endif
                @if($odontogram->pemeriksaan_intra_oral)
                <tr>
                    <td class="label">Pemeriksaan Intra Oral</td>
                    <td class="colon">:</td>
                    <td colspan="4">{{ $odontogram->pemeriksaan_intra_oral }}</td>
                </tr>
                @endif
            </table>
        </div>
        @endif

        <!-- Odontogram Chart -->
        <div class="info-section odontogram-section">
            <h4>Odontogram</h4>

            @php
                // Helper function to get image path
                $kondisiImages = [
                    'sou' => 'sou.png',
                    'car' => 'car.png',
                    'amf' => 'amf.png',
                    'amf-rct' => 'amf-rct.png',
                    'cof-1' => 'cof-1.png',
                    'cof-2' => 'cof-2.png',
                    'cof-rct' => 'cof-rct.png',
                    'fmc' => 'fmc.png',
                    'fmc-rct' => 'fmc-rct.png',
                    'poc' => 'poc.png',
                    'poc-rct' => 'poc-rct.png',
                    'rct' => 'rct.png',
                    'mis' => 'mis.png',
                    'non' => 'non.png',
                    'nvt' => 'nvt.png',
                    'ano' => 'ano.png',
                    'rrx' => 'rrx.png',
                    'une' => 'une.png',
                    'pre' => 'pre.png',
                    'fis' => 'fis.png',
                    'cfr' => 'cfr.png',
                    'frm-acr' => 'frm-acr.png',
                    'ipx-poc' => 'ipx-poc.png',
                    'meb-left' => 'meb-left.png',
                    'meb-center' => 'meb-center.png',
                    'meb-right' => 'meb-right.png',
                    'mcb-left' => 'mcb-left.png',
                    'mcb-right' => 'mcb-right.png',
                    'pob-left' => 'pob-left.png',
                    'pob-center' => 'pob-center.png',
                    'pob-right' => 'pob-right.png',
                    'migrasi-left' => 'migrasi-left.png',
                    'migrasi-right' => 'migrasi-right.png',
                    'rotasi-arahjam' => 'rotasi-arahjam.png',
                    'rotasi-balikjam' => 'rotasi-balikjam.png',
                ];

                // Index gigi data by nomor_gigi
                $gigiIndexed = $odontogram->gigiList->keyBy('nomor_gigi');

                // Teeth arrays
                $gigiDewasaAtasKanan = ['18', '17', '16', '15', '14', '13', '12', '11'];
                $gigiDewasaAtasKiri = ['21', '22', '23', '24', '25', '26', '27', '28'];
                $gigiDewasaBawahKanan = ['48', '47', '46', '45', '44', '43', '42', '41'];
                $gigiDewasaBawahKiri = ['31', '32', '33', '34', '35', '36', '37', '38'];
                $gigiSusuAtasKanan = ['55', '54', '53', '52', '51'];
                $gigiSusuAtasKiri = ['61', '62', '63', '64', '65'];
                $gigiSusuBawahKanan = ['85', '84', '83', '82', '81'];
                $gigiSusuBawahKiri = ['71', '72', '73', '74', '75'];

                // Function to get kondisi for a tooth
                $getKondisi = function($nomor) use ($gigiIndexed) {
                    return $gigiIndexed->has($nomor) ? $gigiIndexed[$nomor]->kondisi : 'sou';
                };

                // Function to get gigi data
                $getGigiData = function($nomor) use ($gigiIndexed) {
                    return $gigiIndexed->get($nomor);
                };

                // Function to get image base64
                $getImageBase64 = function($kondisi) use ($kondisiImages) {
                    $filename = $kondisiImages[$kondisi] ?? 'sou.png';
                    $path = public_path('assets/odontogram/png/' . $filename);
                    if (file_exists($path)) {
                        $data = file_get_contents($path);
                        return 'data:image/png;base64,' . base64_encode($data);
                    }
                    // Fallback to sou.png
                    $souPath = public_path('assets/odontogram/png/sou.png');
                    if (file_exists($souPath)) {
                        $data = file_get_contents($souPath);
                        return 'data:image/png;base64,' . base64_encode($data);
                    }
                    return '';
                };
            @endphp

            <!-- Visual Odontogram Chart -->
            <div class="odontogram-visual">
                <div class="odontogram-visual-title">DIAGRAM GIGI</div>

                <div class="teeth-chart">
                    <!-- Keterangan -->
                    <div style="text-align: center; margin-bottom: 10px; font-size: 8px;">
                        <span style="display: inline-block; margin-right: 15px;">
                            <span style="display: inline-block; width: 10px; height: 10px; background-color: #38bdf8; border: 1px solid #999;"></span>
                            Dinding Normal
                        </span>
                        <span style="display: inline-block;">
                            <span style="display: inline-block; width: 10px; height: 10px; background-color: #f97316; border: 1px solid #999;"></span>
                            Dinding Bermasalah
                        </span>
                    </div>

                    <!-- Header -->
                    <div style="text-align: center; margin-bottom: 5px;">
                        <span style="font-size: 9px; font-weight: bold;">KANAN</span>
                        <span style="margin: 0 50px;">|</span>
                        <span style="font-size: 9px; font-weight: bold;">KIRI</span>
                    </div>

                    <!-- Gigi Dewasa Atas -->
                    <div class="teeth-chart-row">
                        <table>
                            <tr>
                                @foreach($gigiDewasaAtasKanan as $nomor)
                                <td class="tooth-cell">
                                    <div class="tooth-num">{{ $nomor }}</div>
                                </td>
                                @endforeach
                                <td class="chart-divider-vertical" style="width: 2px;"></td>
                                @foreach($gigiDewasaAtasKiri as $nomor)
                                <td class="tooth-cell">
                                    <div class="tooth-num">{{ $nomor }}</div>
                                </td>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach($gigiDewasaAtasKanan as $nomor)
                                <td class="tooth-cell">
                                    <img src="{{ $getImageBase64($getKondisi($nomor)) }}" alt="{{ $nomor }}">
                                </td>
                                @endforeach
                                <td style="width: 2px;"></td>
                                @foreach($gigiDewasaAtasKiri as $nomor)
                                <td class="tooth-cell">
                                    <img src="{{ $getImageBase64($getKondisi($nomor)) }}" alt="{{ $nomor }}">
                                </td>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach($gigiDewasaAtasKanan as $nomor)
                                @php $gigi = $getGigiData($nomor); @endphp
                                <td class="tooth-cell">
                                    @if($gigi && ($gigi->dinding_atas || $gigi->dinding_bawah || $gigi->dinding_kiri || $gigi->dinding_kanan || $gigi->dinding_tengah))
                                    <div class="dinding-box">
                                        <div class="dinding-top {{ $gigi->dinding_atas === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_atas === 'normal' ? 'dinding-normal' : '') }}"></div>
                                        <div class="dinding-left {{ $gigi->dinding_kiri === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_kiri === 'normal' ? 'dinding-normal' : '') }}"></div>
                                        <div class="dinding-center {{ $gigi->dinding_tengah === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_tengah === 'normal' ? 'dinding-normal' : '') }}"></div>
                                        <div class="dinding-right {{ $gigi->dinding_kanan === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_kanan === 'normal' ? 'dinding-normal' : '') }}"></div>
                                        <div class="dinding-bottom {{ $gigi->dinding_bawah === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_bawah === 'normal' ? 'dinding-normal' : '') }}"></div>
                                    </div>
                                    @endif
                                </td>
                                @endforeach
                                <td style="width: 2px;"></td>
                                @foreach($gigiDewasaAtasKiri as $nomor)
                                @php $gigi = $getGigiData($nomor); @endphp
                                <td class="tooth-cell">
                                    @if($gigi && ($gigi->dinding_atas || $gigi->dinding_bawah || $gigi->dinding_kiri || $gigi->dinding_kanan || $gigi->dinding_tengah))
                                    <div class="dinding-box">
                                        <div class="dinding-top {{ $gigi->dinding_atas === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_atas === 'normal' ? 'dinding-normal' : '') }}"></div>
                                        <div class="dinding-left {{ $gigi->dinding_kiri === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_kiri === 'normal' ? 'dinding-normal' : '') }}"></div>
                                        <div class="dinding-center {{ $gigi->dinding_tengah === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_tengah === 'normal' ? 'dinding-normal' : '') }}"></div>
                                        <div class="dinding-right {{ $gigi->dinding_kanan === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_kanan === 'normal' ? 'dinding-normal' : '') }}"></div>
                                        <div class="dinding-bottom {{ $gigi->dinding_bawah === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_bawah === 'normal' ? 'dinding-normal' : '') }}"></div>
                                    </div>
                                    @endif
                                </td>
                                @endforeach
                            </tr>
                        </table>
                    </div>

                    <!-- Gigi Susu Atas -->
                    <div class="teeth-chart-row" style="border-bottom: 1px solid #999; padding-bottom: 8px;">
                        <table>
                            <tr>
                                <td colspan="3"></td>
                                @foreach($gigiSusuAtasKanan as $nomor)
                                <td class="tooth-cell">
                                    <div class="tooth-num">{{ $nomor }}</div>
                                </td>
                                @endforeach
                                <td class="chart-divider-vertical" style="width: 2px;"></td>
                                @foreach($gigiSusuAtasKiri as $nomor)
                                <td class="tooth-cell">
                                    <div class="tooth-num">{{ $nomor }}</div>
                                </td>
                                @endforeach
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                @foreach($gigiSusuAtasKanan as $nomor)
                                <td class="tooth-cell">
                                    <img src="{{ $getImageBase64($getKondisi($nomor)) }}" alt="{{ $nomor }}">
                                </td>
                                @endforeach
                                <td style="width: 2px;"></td>
                                @foreach($gigiSusuAtasKiri as $nomor)
                                <td class="tooth-cell">
                                    <img src="{{ $getImageBase64($getKondisi($nomor)) }}" alt="{{ $nomor }}">
                                </td>
                                @endforeach
                                <td colspan="3"></td>
                            </tr>
                        </table>
                    </div>

                    <!-- Gigi Susu Bawah -->
                    <div class="teeth-chart-row" style="padding-top: 8px;">
                        <table>
                            <tr>
                                <td colspan="3"></td>
                                @foreach($gigiSusuBawahKanan as $nomor)
                                <td class="tooth-cell">
                                    <img src="{{ $getImageBase64($getKondisi($nomor)) }}" alt="{{ $nomor }}">
                                </td>
                                @endforeach
                                <td style="width: 2px;"></td>
                                @foreach($gigiSusuBawahKiri as $nomor)
                                <td class="tooth-cell">
                                    <img src="{{ $getImageBase64($getKondisi($nomor)) }}" alt="{{ $nomor }}">
                                </td>
                                @endforeach
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                @foreach($gigiSusuBawahKanan as $nomor)
                                <td class="tooth-cell">
                                    <div class="tooth-num">{{ $nomor }}</div>
                                </td>
                                @endforeach
                                <td class="chart-divider-vertical" style="width: 2px;"></td>
                                @foreach($gigiSusuBawahKiri as $nomor)
                                <td class="tooth-cell">
                                    <div class="tooth-num">{{ $nomor }}</div>
                                </td>
                                @endforeach
                                <td colspan="3"></td>
                            </tr>
                        </table>
                    </div>

                    <!-- Gigi Dewasa Bawah -->
                    <div class="teeth-chart-row bottom-row">
                        <table>
                            <tr>
                                @foreach($gigiDewasaBawahKanan as $nomor)
                                @php $gigi = $getGigiData($nomor); @endphp
                                <td class="tooth-cell">
                                    @if($gigi && ($gigi->dinding_atas || $gigi->dinding_bawah || $gigi->dinding_kiri || $gigi->dinding_kanan || $gigi->dinding_tengah))
                                    <div class="dinding-box">
                                        <div class="dinding-top {{ $gigi->dinding_atas === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_atas === 'normal' ? 'dinding-normal' : '') }}"></div>
                                        <div class="dinding-left {{ $gigi->dinding_kiri === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_kiri === 'normal' ? 'dinding-normal' : '') }}"></div>
                                        <div class="dinding-center {{ $gigi->dinding_tengah === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_tengah === 'normal' ? 'dinding-normal' : '') }}"></div>
                                        <div class="dinding-right {{ $gigi->dinding_kanan === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_kanan === 'normal' ? 'dinding-normal' : '') }}"></div>
                                        <div class="dinding-bottom {{ $gigi->dinding_bawah === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_bawah === 'normal' ? 'dinding-normal' : '') }}"></div>
                                    </div>
                                    @endif
                                </td>
                                @endforeach
                                <td style="width: 2px;"></td>
                                @foreach($gigiDewasaBawahKiri as $nomor)
                                @php $gigi = $getGigiData($nomor); @endphp
                                <td class="tooth-cell">
                                    @if($gigi && ($gigi->dinding_atas || $gigi->dinding_bawah || $gigi->dinding_kiri || $gigi->dinding_kanan || $gigi->dinding_tengah))
                                    <div class="dinding-box">
                                        <div class="dinding-top {{ $gigi->dinding_atas === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_atas === 'normal' ? 'dinding-normal' : '') }}"></div>
                                        <div class="dinding-left {{ $gigi->dinding_kiri === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_kiri === 'normal' ? 'dinding-normal' : '') }}"></div>
                                        <div class="dinding-center {{ $gigi->dinding_tengah === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_tengah === 'normal' ? 'dinding-normal' : '') }}"></div>
                                        <div class="dinding-right {{ $gigi->dinding_kanan === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_kanan === 'normal' ? 'dinding-normal' : '') }}"></div>
                                        <div class="dinding-bottom {{ $gigi->dinding_bawah === 'bermasalah' ? 'dinding-bermasalah' : ($gigi->dinding_bawah === 'normal' ? 'dinding-normal' : '') }}"></div>
                                    </div>
                                    @endif
                                </td>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach($gigiDewasaBawahKanan as $nomor)
                                <td class="tooth-cell">
                                    <img src="{{ $getImageBase64($getKondisi($nomor)) }}" alt="{{ $nomor }}">
                                </td>
                                @endforeach
                                <td style="width: 2px;"></td>
                                @foreach($gigiDewasaBawahKiri as $nomor)
                                <td class="tooth-cell">
                                    <img src="{{ $getImageBase64($getKondisi($nomor)) }}" alt="{{ $nomor }}">
                                </td>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach($gigiDewasaBawahKanan as $nomor)
                                <td class="tooth-cell">
                                    <div class="tooth-num">{{ $nomor }}</div>
                                </td>
                                @endforeach
                                <td class="chart-divider-vertical" style="width: 2px;"></td>
                                @foreach($gigiDewasaBawahKiri as $nomor)
                                <td class="tooth-cell">
                                    <div class="tooth-num">{{ $nomor }}</div>
                                </td>
                                @endforeach
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Kondisi Gigi yang Bermasalah -->
            @php
                $gigiProblems = $odontogram->gigiList->filter(function($gigi) {
                    return $gigi->kondisi !== 'sou';
                });
            @endphp

            @if($gigiProblems->count() > 0)
            <p style="font-size: 9px; font-weight: bold; margin: 10px 0 5px 0;">Detail Kondisi Gigi:</p>
            <table class="kondisi-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">No. Gigi</th>
                        <th style="width: 50px;">Gambar</th>
                        <th style="width: 130px;">Kondisi</th>
                        <th>Dinding Bermasalah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gigiProblems as $gigi)
                    <tr>
                        <td style="text-align: center; font-weight: bold;">{{ $gigi->nomor_gigi }}</td>
                        <td style="text-align: center;">
                            <img src="{{ $getImageBase64($gigi->kondisi) }}" alt="{{ $gigi->kondisi }}" style="width: 25px; height: auto;">
                        </td>
                        <td>{{ $kondisiLabels[$gigi->kondisi] ?? $gigi->kondisi }}</td>
                        <td>
                            @php
                                $dindingBermasalah = [];
                                if($gigi->dinding_atas === 'bermasalah') $dindingBermasalah[] = 'Atas';
                                if($gigi->dinding_bawah === 'bermasalah') $dindingBermasalah[] = 'Bawah';
                                if($gigi->dinding_kiri === 'bermasalah') $dindingBermasalah[] = 'Kiri';
                                if($gigi->dinding_kanan === 'bermasalah') $dindingBermasalah[] = 'Kanan';
                                if($gigi->dinding_tengah === 'bermasalah') $dindingBermasalah[] = 'Tengah';
                            @endphp
                            {{ count($dindingBermasalah) > 0 ? implode(', ', $dindingBermasalah) : '-' }}
                        </td>
                        <td>{{ $gigi->keterangan ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p style="text-align: center; color: #666; padding: 10px; font-size: 9px;">Semua gigi dalam kondisi normal (Sound)</p>
            @endif
        </div>

        <!-- Pemeriksaan Lainnya -->
        <div class="info-section">
            <h4>Pemeriksaan Lainnya</h4>
            <table class="info-table">
                <tr>
                    <td class="label">Occlusi</td>
                    <td class="colon">:</td>
                    <td>{{ ucwords(str_replace('_', ' ', $odontogram->occlusi)) }}</td>
                    <td class="label">Torus Palatinus</td>
                    <td class="colon">:</td>
                    <td>{{ ucwords(str_replace('_', ' ', $odontogram->torus_palatinus)) }}</td>
                </tr>
                <tr>
                    <td class="label">Torus Mandibularis</td>
                    <td class="colon">:</td>
                    <td>{{ ucwords(str_replace('_', ' ', $odontogram->torus_mandibularis)) }}</td>
                    <td class="label">Palatum</td>
                    <td class="colon">:</td>
                    <td>{{ ucwords($odontogram->palatum) }}</td>
                </tr>
                <tr>
                    <td class="label">Diastema</td>
                    <td class="colon">:</td>
                    <td>{{ $odontogram->diastema ? 'Ada' : 'Tidak Ada' }}</td>
                    <td class="label">Gigi Anomali</td>
                    <td class="colon">:</td>
                    <td>{{ $odontogram->gigi_anomali ? 'Ada' : 'Tidak Ada' }}</td>
                </tr>
            </table>
        </div>

        <!-- Status DMF -->
        <div class="info-section">
            <h4>Status DMF (Decay-Missing-Filled)</h4>
            <div class="dmf-section">
                <div class="dmf-box">
                    <div class="number">{{ $odontogram->status_d }}</div>
                    <div class="label">D (Decay)</div>
                </div>
                <div class="dmf-box">
                    <div class="number">{{ $odontogram->status_m }}</div>
                    <div class="label">M (Missing)</div>
                </div>
                <div class="dmf-box">
                    <div class="number">{{ $odontogram->status_f }}</div>
                    <div class="label">F (Filled)</div>
                </div>
                <div class="dmf-box" style="background-color: #f0f0f0;">
                    <div class="number">{{ $odontogram->status_d + $odontogram->status_m + $odontogram->status_f }}</div>
                    <div class="label">Total DMF</div>
                </div>
            </div>
        </div>

        <!-- Hasil Pemeriksaan Penunjang -->
        @if($odontogram->hasil_pemeriksaan_penunjang)
        <div class="info-section">
            <h4>Hasil Pemeriksaan Penunjang</h4>
            <div class="diagnosa-item">
                <div class="content">{{ $odontogram->hasil_pemeriksaan_penunjang }}</div>
            </div>
        </div>
        @endif

        <!-- Diagnosa & Planning -->
        <div class="info-section diagnosa-section">
            <h4>Diagnosa & Rencana Perawatan</h4>

            <div class="diagnosa-item">
                <div class="label">Diagnosa:</div>
                <div class="content">{{ $odontogram->diagnosa ?? '-' }}</div>
            </div>

            <div class="diagnosa-item">
                <div class="label">Planning / Rencana Perawatan:</div>
                <div class="content">{{ $odontogram->planning ?? '-' }}</div>
            </div>

            @if($odontogram->edukasi)
            <div class="diagnosa-item">
                <div class="label">Edukasi:</div>
                <div class="content">{{ $odontogram->edukasi }}</div>
            </div>
            @endif
        </div>

        <!-- Footer / Tanda Tangan -->
        <div class="footer">
            <div class="signature-section">
                <div class="signature-box">
                    &nbsp;
                </div>
                <div class="signature-box">
                    <div class="date">{{ $odontogram->kunjungan->poliRelation->lokasi ?? 'Kota Sehat' }}, {{ $odontogram->created_at->format('d F Y') }}</div>
                    <div class="title-sign">Dokter Pemeriksa,</div>
                    <div class="name">{{ $odontogram->kunjungan->dokter->nama_dokter ?? '________________' }}</div>
                </div>
            </div>
        </div>

        <!-- Footer Info -->
        <div style="margin-top: 30px; border-top: 1px solid #ddd; padding-top: 10px; font-size: 8px; color: #999; text-align: center;">
            Dokumen ini dicetak dari sistem Mini SIMRS pada {{ now()->format('d/m/Y H:i:s') }}
        </div>
    </div>
</body>
</html>
