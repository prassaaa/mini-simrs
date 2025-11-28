<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Rekam Medis Gigi - {{ $odontogram->kunjungan->pasien->nama_pasien }}</title>
    <style>
        @page {
            margin: 15mm 15mm 15mm 15mm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Serif', Georgia, Times, serif;
            font-size: 9px;
            line-height: 1.3;
            color: #000;
        }

        .container {
            width: 100%;
        }

        /* =============== KOP SURAT RS BHAYANGKARA =============== */
        .kop-surat {
            width: 100%;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .kop-surat table {
            width: 100%;
        }

        .kop-surat .logo-cell {
            width: 80px;
            text-align: center;
            vertical-align: middle;
        }

        .kop-surat .logo {
            width: 60px;
            height: auto;
        }

        .kop-surat .info-cell {
            text-align: center;
            vertical-align: middle;
        }

        .kop-surat .rs-name {
            font-size: 16px;
            font-weight: bold;
            color: #000;
            letter-spacing: 1px;
        }

        .kop-surat .rs-subtitle {
            font-size: 11px;
            font-weight: bold;
            margin-top: 2px;
        }

        .kop-surat .rs-address {
            font-size: 8px;
            margin-top: 3px;
            line-height: 1.4;
        }

        /* =============== JUDUL DOKUMEN =============== */
        .doc-title {
            text-align: center;
            margin: 15px 0;
            padding: 8px 0;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
        }

        .doc-title h2 {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .doc-number {
            font-size: 8px;
            margin-top: 3px;
        }

        /* =============== DATA PASIEN =============== */
        .section {
            margin-bottom: 12px;
        }

        .section-title {
            font-size: 10px;
            font-weight: bold;
            background-color: #e8e8e8;
            padding: 4px 8px;
            margin-bottom: 8px;
            border-left: 3px solid #000;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table td {
            padding: 3px 5px;
            vertical-align: top;
            font-size: 9px;
        }

        .data-table .label {
            width: 120px;
            font-weight: bold;
        }

        .data-table .colon {
            width: 10px;
            text-align: center;
        }

        .data-table .value {
            border-bottom: 1px dotted #999;
        }

        /* =============== ODONTOGRAM CHART =============== */
        .odontogram-box {
            border: 1px solid #000;
            padding: 10px;
            margin: 10px 0;
            background-color: #fafafa;
        }

        .odontogram-title {
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .teeth-chart {
            width: 100%;
        }

        .teeth-chart-row {
            text-align: center;
            margin: 3px 0;
        }

        .teeth-chart-row table {
            margin: 0 auto;
            border-collapse: collapse;
        }

        .teeth-chart-row td {
            padding: 1px;
            text-align: center;
            vertical-align: bottom;
        }

        .teeth-chart-row.bottom-row td {
            vertical-align: top;
        }

        .tooth-cell {
            width: 26px;
            text-align: center;
        }

        .tooth-cell img {
            width: 20px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .tooth-cell .tooth-num {
            font-size: 7px;
            font-weight: bold;
            color: #000;
        }

        .chart-divider-vertical {
            width: 2px;
            background-color: #000;
        }

        .legend-box {
            text-align: center;
            margin-bottom: 8px;
            font-size: 7px;
        }

        .legend-box span {
            display: inline-block;
            margin: 0 8px;
        }

        .legend-color {
            display: inline-block;
            width: 8px;
            height: 8px;
            border: 1px solid #666;
            vertical-align: middle;
            margin-right: 3px;
        }

        .dinding-box {
            width: 16px;
            height: 16px;
            border: 1px solid #333;
            margin: 2px auto;
            display: table;
        }

        .dinding-box-row {
            display: table-row;
        }

        .dinding-box-cell {
            display: table-cell;
            width: 5px;
            height: 5px;
        }

        .dinding-normal { background-color: #4ade80; }
        .dinding-bermasalah { background-color: #ef4444; }

        /* =============== KONDISI GIGI TABLE =============== */
        .kondisi-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            font-size: 8px;
        }

        .kondisi-table th,
        .kondisi-table td {
            border: 1px solid #000;
            padding: 4px 6px;
            text-align: left;
        }

        .kondisi-table th {
            background-color: #e8e8e8;
            font-weight: bold;
            text-align: center;
        }

        .kondisi-table td.center {
            text-align: center;
        }

        /* =============== PEMERIKSAAN TABLE =============== */
        .pemeriksaan-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }

        .pemeriksaan-table td {
            padding: 3px 6px;
            border: 1px solid #000;
        }

        .pemeriksaan-table .label-cell {
            background-color: #f0f0f0;
            font-weight: bold;
            width: 25%;
        }

        /* =============== DMF BOX =============== */
        .dmf-container {
            text-align: center;
            margin: 10px 0;
        }

        .dmf-box {
            display: inline-block;
            border: 2px solid #000;
            width: 60px;
            margin: 0 5px;
            text-align: center;
        }

        .dmf-box .number {
            font-size: 18px;
            font-weight: bold;
            padding: 5px;
            border-bottom: 1px solid #000;
        }

        .dmf-box .label {
            font-size: 8px;
            padding: 3px;
            background-color: #e8e8e8;
        }

        .dmf-total {
            background-color: #d0d0d0;
        }

        /* =============== DIAGNOSA BOX =============== */
        .diagnosa-box {
            border: 1px solid #000;
            margin-bottom: 8px;
        }

        .diagnosa-box .box-label {
            background-color: #e8e8e8;
            padding: 4px 8px;
            font-weight: bold;
            font-size: 9px;
            border-bottom: 1px solid #000;
        }

        .diagnosa-box .box-content {
            padding: 8px;
            min-height: 35px;
            font-size: 9px;
        }

        /* =============== TANDA TANGAN =============== */
        .ttd-section {
            width: 100%;
            margin-top: 20px;
            page-break-inside: avoid;
        }

        .ttd-section table {
            width: 100%;
        }

        .ttd-section td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 5px;
        }

        .ttd-box {
            text-align: center;
        }

        .ttd-box .ttd-title {
            font-size: 9px;
            margin-bottom: 50px;
        }

        .ttd-box .ttd-line {
            border-bottom: 1px solid #000;
            width: 150px;
            margin: 0 auto;
        }

        .ttd-box .ttd-name {
            font-size: 9px;
            font-weight: bold;
            margin-top: 3px;
        }

        .ttd-box .ttd-nip {
            font-size: 8px;
        }

        /* =============== FOOTER =============== */
        .doc-footer {
            margin-top: 15px;
            padding-top: 8px;
            border-top: 1px solid #ccc;
            font-size: 7px;
            color: #666;
            text-align: center;
        }

        .form-number {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 8px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- KOP SURAT RS BHAYANGKARA KEDIRI -->
        <div class="kop-surat">
            <table>
                <tr>
                    <td class="logo-cell">
                        {{-- Logo Polri --}}
                        @php
                            $polriLogoPath = public_path('assets/images/polri.png');
                            $polriLogoBase64 = file_exists($polriLogoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($polriLogoPath)) : '';
                        @endphp
                        @if($polriLogoBase64)
                            <img src="{{ $polriLogoBase64 }}" alt="Logo Polri" style="width: 55px; height: auto; margin: 0 auto; display: block;">
                        @else
                            <div style="width: 55px; height: 55px; border: 2px solid #000; border-radius: 50%; margin: 0 auto; text-align: center; line-height: 50px;">
                                <span style="font-size: 7px; font-weight: bold;">POLRI</span>
                            </div>
                        @endif
                    </td>
                    <td class="info-cell">
                        <div class="rs-name">RUMAH SAKIT BHAYANGKARA KEDIRI</div>
                        <div class="rs-subtitle">KEPOLISIAN DAERAH JAWA TIMUR</div>
                        <div class="rs-address">
                            Jl. Kombes Pol. Duryat No. 1, Mojoroto, Kec. Mojoroto, Kota Kediri, Jawa Timur 64112<br>
                            Telp: (0354) 771200 | Fax: (0354) 771201 | Email: rsbhayangkarakediri@polri.go.id
                        </div>
                    </td>
                    <td class="logo-cell">
                        {{-- Logo RS --}}
                        @php
                            $rsLogoPath = public_path('assets/images/rs.png');
                            $rsLogoBase64 = file_exists($rsLogoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($rsLogoPath)) : '';
                        @endphp
                        @if($rsLogoBase64)
                            <img src="{{ $rsLogoBase64 }}" alt="Logo RS" style="width: 55px; height: auto; margin: 0 auto; display: block;">
                        @else
                            <div style="width: 55px; height: 55px; border: 2px solid #000; border-radius: 50%; margin: 0 auto; text-align: center; line-height: 50px;">
                                <span style="font-size: 7px; font-weight: bold;">RS</span>
                            </div>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <!-- JUDUL DOKUMEN -->
        <div class="doc-title">
            <h2>REKAM MEDIS ODONTOGRAM</h2>
            <div class="doc-number">No. RM: {{ $odontogram->kunjungan->no_rm }} / Reg: {{ $odontogram->kunjungan->no_registrasi_kunjungan }}</div>
        </div>

        <!-- DATA PASIEN -->
        <div class="section">
            <div class="section-title">I. IDENTITAS PASIEN</div>
            <table class="data-table">
                <tr>
                    <td class="label">Nama Lengkap</td>
                    <td class="colon">:</td>
                    <td class="value">{{ $odontogram->kunjungan->pasien->nama_pasien }}</td>
                    <td class="label">No. Rekam Medis</td>
                    <td class="colon">:</td>
                    <td class="value">{{ $odontogram->kunjungan->no_rm }}</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Lahir</td>
                    <td class="colon">:</td>
                    <td class="value">{{ $odontogram->kunjungan->pasien->tanggal_lahir ? \Carbon\Carbon::parse($odontogram->kunjungan->pasien->tanggal_lahir)->format('d-m-Y') : '-' }}</td>
                    <td class="label">Jenis Kelamin</td>
                    <td class="colon">:</td>
                    <td class="value">{{ $odontogram->kunjungan->pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <td class="label">Alamat</td>
                    <td class="colon">:</td>
                    <td class="value" colspan="4">{{ $odontogram->kunjungan->pasien->alamat ?? '-' }}</td>
                </tr>
            </table>
        </div>

        <!-- DATA KUNJUNGAN -->
        <div class="section">
            <div class="section-title">II. DATA KUNJUNGAN</div>
            <table class="data-table">
                <tr>
                    <td class="label">Tanggal Periksa</td>
                    <td class="colon">:</td>
                    <td class="value">{{ $odontogram->created_at->format('d-m-Y H:i') }} WIB</td>
                    <td class="label">No. Registrasi</td>
                    <td class="colon">:</td>
                    <td class="value">{{ $odontogram->kunjungan->no_registrasi_kunjungan }}</td>
                </tr>
                <tr>
                    <td class="label">Dokter Pemeriksa</td>
                    <td class="colon">:</td>
                    <td class="value">{{ $odontogram->kunjungan->dokter->nama_dokter ?? '-' }}</td>
                    <td class="label">Poli / Unit</td>
                    <td class="colon">:</td>
                    <td class="value">{{ $odontogram->kunjungan->poliRelation->nama_poli ?? 'Poli Gigi & Mulut' }}</td>
                </tr>
            </table>
        </div>

        <!-- PEMERIKSAAN FISIK -->
        @if($odontogram->pemeriksaan_ekstra_oral || $odontogram->pemeriksaan_intra_oral)
        <div class="section">
            <div class="section-title">III. PEMERIKSAAN FISIK</div>
            <table class="pemeriksaan-table">
                @if($odontogram->pemeriksaan_ekstra_oral)
                <tr>
                    <td class="label-cell">Ekstra Oral</td>
                    <td>{{ $odontogram->pemeriksaan_ekstra_oral }}</td>
                </tr>
                @endif
                @if($odontogram->pemeriksaan_intra_oral)
                <tr>
                    <td class="label-cell">Intra Oral</td>
                    <td>{{ $odontogram->pemeriksaan_intra_oral }}</td>
                </tr>
                @endif
            </table>
        </div>
        @endif

        <!-- ODONTOGRAM -->
        <div class="section">
            <div class="section-title">{{ $odontogram->pemeriksaan_ekstra_oral || $odontogram->pemeriksaan_intra_oral ? 'IV' : 'III' }}. STATUS ODONTOGRAM</div>

            @php
                $kondisiImages = [
                    'sou' => 'sou.png', 'car' => 'car.png', 'amf' => 'amf.png', 'amf-rct' => 'amf-rct.png',
                    'cof-1' => 'cof-1.png', 'cof-2' => 'cof-2.png', 'cof-rct' => 'cof-rct.png',
                    'fmc' => 'fmc.png', 'fmc-rct' => 'fmc-rct.png', 'poc' => 'poc.png', 'poc-rct' => 'poc-rct.png',
                    'rct' => 'rct.png', 'mis' => 'mis.png', 'non' => 'non.png', 'nvt' => 'nvt.png',
                    'ano' => 'ano.png', 'rrx' => 'rrx.png', 'une' => 'une.png', 'pre' => 'pre.png',
                    'fis' => 'fis.png', 'cfr' => 'cfr.png', 'frm-acr' => 'frm-acr.png', 'ipx-poc' => 'ipx-poc.png',
                    'meb-left' => 'meb-left.png', 'meb-center' => 'meb-center.png', 'meb-right' => 'meb-right.png',
                    'mcb-left' => 'mcb-left.png', 'mcb-right' => 'mcb-right.png',
                    'pob-left' => 'pob-left.png', 'pob-center' => 'pob-center.png', 'pob-right' => 'pob-right.png',
                    'migrasi-left' => 'migrasi-left.png', 'migrasi-right' => 'migrasi-right.png',
                    'rotasi-arahjam' => 'rotasi-arahjam.png', 'rotasi-balikjam' => 'rotasi-balikjam.png',
                ];

                $gigiIndexed = $odontogram->gigiList->keyBy('nomor_gigi');

                $gigiDewasaAtasKanan = ['18', '17', '16', '15', '14', '13', '12', '11'];
                $gigiDewasaAtasKiri = ['21', '22', '23', '24', '25', '26', '27', '28'];
                $gigiDewasaBawahKanan = ['48', '47', '46', '45', '44', '43', '42', '41'];
                $gigiDewasaBawahKiri = ['31', '32', '33', '34', '35', '36', '37', '38'];
                $gigiSusuAtasKanan = ['55', '54', '53', '52', '51'];
                $gigiSusuAtasKiri = ['61', '62', '63', '64', '65'];
                $gigiSusuBawahKanan = ['85', '84', '83', '82', '81'];
                $gigiSusuBawahKiri = ['71', '72', '73', '74', '75'];

                $getKondisi = function($nomor) use ($gigiIndexed) {
                    return $gigiIndexed->has($nomor) ? $gigiIndexed[$nomor]->kondisi : 'sou';
                };

                $getGigiData = function($nomor) use ($gigiIndexed) {
                    return $gigiIndexed->get($nomor);
                };

                $getImageBase64 = function($kondisi) use ($kondisiImages) {
                    $filename = $kondisiImages[$kondisi] ?? 'sou.png';
                    $path = public_path('assets/odontogram/png/' . $filename);
                    if (file_exists($path)) {
                        return 'data:image/png;base64,' . base64_encode(file_get_contents($path));
                    }
                    $souPath = public_path('assets/odontogram/png/sou.png');
                    if (file_exists($souPath)) {
                        return 'data:image/png;base64,' . base64_encode(file_get_contents($souPath));
                    }
                    return '';
                };

                // Function to render dinding box using table layout (DomPDF compatible)
                // Only show if there's a problem with the tooth
                $renderDindingBox = function($nomor) use ($gigiIndexed) {
                    $gigi = $gigiIndexed->get($nomor);

                    // If no gigi data or kondisi is 'sou' (sound/normal), don't show dinding box
                    if (!$gigi || $gigi->kondisi === 'sou') {
                        return '';
                    }

                    // Check if any dinding is bermasalah
                    $hasDindingProblem = ($gigi->dinding_atas === 'bermasalah' ||
                                         $gigi->dinding_bawah === 'bermasalah' ||
                                         $gigi->dinding_kiri === 'bermasalah' ||
                                         $gigi->dinding_kanan === 'bermasalah' ||
                                         $gigi->dinding_tengah === 'bermasalah');

                    // If no dinding problem, don't show the box
                    if (!$hasDindingProblem) {
                        return '';
                    }

                    $top = $gigi->dinding_atas === 'bermasalah' ? 'dinding-bermasalah' : 'dinding-normal';
                    $bottom = $gigi->dinding_bawah === 'bermasalah' ? 'dinding-bermasalah' : 'dinding-normal';
                    $left = $gigi->dinding_kiri === 'bermasalah' ? 'dinding-bermasalah' : 'dinding-normal';
                    $right = $gigi->dinding_kanan === 'bermasalah' ? 'dinding-bermasalah' : 'dinding-normal';
                    $center = $gigi->dinding_tengah === 'bermasalah' ? 'dinding-bermasalah' : 'dinding-normal';

                    return '<table style="width: 16px; height: 16px; border-collapse: collapse; margin: 2px auto; border: 1px solid #333;">
                        <tr>
                            <td style="width: 5px; height: 5px; border: none;"></td>
                            <td class="' . $top . '" style="width: 6px; height: 5px; border: none;"></td>
                            <td style="width: 5px; height: 5px; border: none;"></td>
                        </tr>
                        <tr>
                            <td class="' . $left . '" style="width: 5px; height: 6px; border: none;"></td>
                            <td class="' . $center . '" style="width: 6px; height: 6px; border: none;"></td>
                            <td class="' . $right . '" style="width: 5px; height: 6px; border: none;"></td>
                        </tr>
                        <tr>
                            <td style="width: 5px; height: 5px; border: none;"></td>
                            <td class="' . $bottom . '" style="width: 6px; height: 5px; border: none;"></td>
                            <td style="width: 5px; height: 5px; border: none;"></td>
                        </tr>
                    </table>';
                };
            @endphp

            <div class="odontogram-box">
                <div class="odontogram-title">Diagram Gigi Pasien</div>

                <div class="legend-box">
                    <span><span class="legend-color" style="background-color: #4ade80;"></span> Normal</span>
                    <span><span class="legend-color" style="background-color: #ef4444;"></span> Bermasalah</span>
                </div>

                <div style="text-align: center; margin-bottom: 5px; font-size: 8px; font-weight: bold;">
                    <span>KANAN (R)</span>
                    <span style="margin: 0 80px;">|</span>
                    <span>KIRI (L)</span>
                </div>

                <div class="teeth-chart">
                    <!-- Gigi Dewasa Atas -->
                    <div class="teeth-chart-row">
                        <table>
                            <tr>
                                @foreach($gigiDewasaAtasKanan as $nomor)
                                <td class="tooth-cell"><div class="tooth-num">{{ $nomor }}</div></td>
                                @endforeach
                                <td style="width: 2px;"></td>
                                @foreach($gigiDewasaAtasKiri as $nomor)
                                <td class="tooth-cell"><div class="tooth-num">{{ $nomor }}</div></td>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach($gigiDewasaAtasKanan as $nomor)
                                <td class="tooth-cell"><img src="{{ $getImageBase64($getKondisi($nomor)) }}" alt="{{ $nomor }}"></td>
                                @endforeach
                                <td style="width: 2px; background-color: #000;"></td>
                                @foreach($gigiDewasaAtasKiri as $nomor)
                                <td class="tooth-cell"><img src="{{ $getImageBase64($getKondisi($nomor)) }}" alt="{{ $nomor }}"></td>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach($gigiDewasaAtasKanan as $nomor)
                                <td class="tooth-cell">{!! $renderDindingBox($nomor) !!}</td>
                                @endforeach
                                <td style="width: 2px; background-color: #000;"></td>
                                @foreach($gigiDewasaAtasKiri as $nomor)
                                <td class="tooth-cell">{!! $renderDindingBox($nomor) !!}</td>
                                @endforeach
                            </tr>
                        </table>
                    </div>

                    <!-- Gigi Susu Atas -->
                    <div class="teeth-chart-row" style="border-bottom: 1px solid #000; padding-bottom: 5px;">
                        <table>
                            <tr>
                                <td colspan="3"></td>
                                @foreach($gigiSusuAtasKanan as $nomor)
                                <td class="tooth-cell"><div class="tooth-num">{{ $nomor }}</div></td>
                                @endforeach
                                <td style="width: 2px;"></td>
                                @foreach($gigiSusuAtasKiri as $nomor)
                                <td class="tooth-cell"><div class="tooth-num">{{ $nomor }}</div></td>
                                @endforeach
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                @foreach($gigiSusuAtasKanan as $nomor)
                                <td class="tooth-cell"><img src="{{ $getImageBase64($getKondisi($nomor)) }}" alt="{{ $nomor }}"></td>
                                @endforeach
                                <td style="width: 2px; background-color: #000;"></td>
                                @foreach($gigiSusuAtasKiri as $nomor)
                                <td class="tooth-cell"><img src="{{ $getImageBase64($getKondisi($nomor)) }}" alt="{{ $nomor }}"></td>
                                @endforeach
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                @foreach($gigiSusuAtasKanan as $nomor)
                                <td class="tooth-cell">{!! $renderDindingBox($nomor) !!}</td>
                                @endforeach
                                <td style="width: 2px; background-color: #000;"></td>
                                @foreach($gigiSusuAtasKiri as $nomor)
                                <td class="tooth-cell">{!! $renderDindingBox($nomor) !!}</td>
                                @endforeach
                                <td colspan="3"></td>
                            </tr>
                        </table>
                    </div>

                    <!-- Gigi Susu Bawah -->
                    <div class="teeth-chart-row" style="padding-top: 5px;">
                        <table>
                            <tr>
                                <td colspan="3"></td>
                                @foreach($gigiSusuBawahKanan as $nomor)
                                <td class="tooth-cell">{!! $renderDindingBox($nomor) !!}</td>
                                @endforeach
                                <td style="width: 2px; background-color: #000;"></td>
                                @foreach($gigiSusuBawahKiri as $nomor)
                                <td class="tooth-cell">{!! $renderDindingBox($nomor) !!}</td>
                                @endforeach
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                @foreach($gigiSusuBawahKanan as $nomor)
                                <td class="tooth-cell"><img src="{{ $getImageBase64($getKondisi($nomor)) }}" alt="{{ $nomor }}"></td>
                                @endforeach
                                <td style="width: 2px; background-color: #000;"></td>
                                @foreach($gigiSusuBawahKiri as $nomor)
                                <td class="tooth-cell"><img src="{{ $getImageBase64($getKondisi($nomor)) }}" alt="{{ $nomor }}"></td>
                                @endforeach
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                @foreach($gigiSusuBawahKanan as $nomor)
                                <td class="tooth-cell"><div class="tooth-num">{{ $nomor }}</div></td>
                                @endforeach
                                <td style="width: 2px;"></td>
                                @foreach($gigiSusuBawahKiri as $nomor)
                                <td class="tooth-cell"><div class="tooth-num">{{ $nomor }}</div></td>
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
                                <td class="tooth-cell">{!! $renderDindingBox($nomor) !!}</td>
                                @endforeach
                                <td style="width: 2px; background-color: #000;"></td>
                                @foreach($gigiDewasaBawahKiri as $nomor)
                                <td class="tooth-cell">{!! $renderDindingBox($nomor) !!}</td>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach($gigiDewasaBawahKanan as $nomor)
                                <td class="tooth-cell"><img src="{{ $getImageBase64($getKondisi($nomor)) }}" alt="{{ $nomor }}"></td>
                                @endforeach
                                <td style="width: 2px; background-color: #000;"></td>
                                @foreach($gigiDewasaBawahKiri as $nomor)
                                <td class="tooth-cell"><img src="{{ $getImageBase64($getKondisi($nomor)) }}" alt="{{ $nomor }}"></td>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach($gigiDewasaBawahKanan as $nomor)
                                <td class="tooth-cell"><div class="tooth-num">{{ $nomor }}</div></td>
                                @endforeach
                                <td style="width: 2px;"></td>
                                @foreach($gigiDewasaBawahKiri as $nomor)
                                <td class="tooth-cell"><div class="tooth-num">{{ $nomor }}</div></td>
                                @endforeach
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Detail Kondisi Gigi -->
            @php
                $gigiProblems = $odontogram->gigiList->filter(function($gigi) {
                    return $gigi->kondisi !== 'sou';
                });
            @endphp

            @if($gigiProblems->count() > 0)
            <p style="font-size: 9px; font-weight: bold; margin: 8px 0 5px 0;">Detail Kondisi Gigi:</p>
            <table class="kondisi-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No. Gigi</th>
                        <th style="width: 40px;">Gambar</th>
                        <th style="width: 40px;">Dinding</th>
                        <th style="width: 120px;">Kondisi</th>
                        <th>Dinding Bermasalah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gigiProblems as $gigi)
                    <tr>
                        <td class="center" style="font-weight: bold;">{{ $gigi->nomor_gigi }}</td>
                        <td class="center"><img src="{{ $getImageBase64($gigi->kondisi) }}" alt="{{ $gigi->kondisi }}" style="width: 20px; height: auto;"></td>
                        <td class="center">{!! $renderDindingBox($gigi->nomor_gigi) !!}</td>
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
            <p style="text-align: center; color: #666; padding: 8px; font-size: 9px; font-style: italic;">* Semua gigi dalam kondisi normal (Sound) *</p>
            @endif
        </div>

        <!-- PEMERIKSAAN LAINNYA -->
        <div class="section">
            <div class="section-title">{{ ($odontogram->pemeriksaan_ekstra_oral || $odontogram->pemeriksaan_intra_oral) ? 'V' : 'IV' }}. PEMERIKSAAN LAINNYA</div>
            <table class="pemeriksaan-table">
                <tr>
                    <td class="label-cell">Occlusi</td>
                    <td>{{ ucwords(str_replace('_', ' ', $odontogram->occlusi)) }}</td>
                    <td class="label-cell">Torus Palatinus</td>
                    <td>{{ ucwords(str_replace('_', ' ', $odontogram->torus_palatinus)) }}</td>
                </tr>
                <tr>
                    <td class="label-cell">Torus Mandibularis</td>
                    <td>{{ ucwords(str_replace('_', ' ', $odontogram->torus_mandibularis)) }}</td>
                    <td class="label-cell">Palatum</td>
                    <td>{{ ucwords($odontogram->palatum) }}</td>
                </tr>
                <tr>
                    <td class="label-cell">Diastema</td>
                    <td>{{ $odontogram->diastema ? 'Ada' : 'Tidak Ada' }}</td>
                    <td class="label-cell">Gigi Anomali</td>
                    <td>{{ $odontogram->gigi_anomali ? 'Ada' : 'Tidak Ada' }}</td>
                </tr>
            </table>

            <!-- Status DMF -->
            <div style="margin-top: 10px;">
                <p style="font-size: 9px; font-weight: bold; margin-bottom: 5px;">Status DMF (Decay-Missing-Filled):</p>
                <div class="dmf-container">
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
                    <div class="dmf-box dmf-total">
                        <div class="number">{{ $odontogram->status_d + $odontogram->status_m + $odontogram->status_f }}</div>
                        <div class="label">TOTAL</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- HASIL PEMERIKSAAN PENUNJANG -->
        @if($odontogram->hasil_pemeriksaan_penunjang)
        <div class="section">
            <div class="section-title">{{ ($odontogram->pemeriksaan_ekstra_oral || $odontogram->pemeriksaan_intra_oral) ? 'VI' : 'V' }}. HASIL PEMERIKSAAN PENUNJANG</div>
            <div class="diagnosa-box">
                <div class="box-content">{{ $odontogram->hasil_pemeriksaan_penunjang }}</div>
            </div>
        </div>
        @endif

        <!-- DIAGNOSA & PLANNING -->
        <div class="section">
            @php
                $sectionNum = ($odontogram->pemeriksaan_ekstra_oral || $odontogram->pemeriksaan_intra_oral) ? 'VI' : 'V';
                if ($odontogram->hasil_pemeriksaan_penunjang) {
                    $sectionNum = ($odontogram->pemeriksaan_ekstra_oral || $odontogram->pemeriksaan_intra_oral) ? 'VII' : 'VI';
                }
            @endphp
            <div class="section-title">{{ $sectionNum }}. DIAGNOSA & RENCANA PERAWATAN</div>

            <div class="diagnosa-box">
                <div class="box-label">Diagnosa</div>
                <div class="box-content">{{ $odontogram->diagnosa ?? '-' }}</div>
            </div>

            <div class="diagnosa-box">
                <div class="box-label">Rencana Perawatan (Planning)</div>
                <div class="box-content">{{ $odontogram->planning ?? '-' }}</div>
            </div>

            @if($odontogram->edukasi)
            <div class="diagnosa-box">
                <div class="box-label">Edukasi Pasien</div>
                <div class="box-content">{{ $odontogram->edukasi }}</div>
            </div>
            @endif
        </div>

        <!-- TANDA TANGAN -->
        <div class="ttd-section">
            <table>
                <tr>
                    <td>
                        <div class="ttd-box">
                            <div class="ttd-title">Pasien/Keluarga</div>
                            <div class="ttd-line"></div>
                            <div class="ttd-name">( {{ $odontogram->kunjungan->pasien->nama_pasien }} )</div>
                        </div>
                    </td>
                    <td>
                        <div class="ttd-box">
                            <div class="ttd-title">Kediri, {{ $odontogram->created_at->format('d F Y') }}<br>Dokter Pemeriksa,</div>
                            <div class="ttd-line"></div>
                            <div class="ttd-name">{{ $odontogram->kunjungan->dokter->nama_dokter ?? '.............................' }}</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- FOOTER -->
        <div class="doc-footer">
            <p>RS Bhayangkara Kediri - Dokumen Rekam Medis Elektronik</p>
            <p>Dicetak pada: {{ now()->format('d-m-Y H:i:s') }} WIB </p>
        </div>
    </div>
</body>
</html>
