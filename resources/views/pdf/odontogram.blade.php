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
                    <td>{{ $odontogram->kunjungan->poli_relation->nama_poli ?? '-' }}</td>
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

            <!-- Kondisi Gigi yang Bermasalah -->
            @php
                $gigiProblems = $odontogram->gigiList->filter(function($gigi) {
                    return $gigi->kondisi !== 'sou';
                });
            @endphp

            @if($gigiProblems->count() > 0)
            <table class="kondisi-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">No. Gigi</th>
                        <th style="width: 150px;">Kondisi</th>
                        <th>Dinding Bermasalah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gigiProblems as $gigi)
                    <tr>
                        <td style="text-align: center; font-weight: bold;">{{ $gigi->nomor_gigi }}</td>
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
            <p style="text-align: center; color: #666; padding: 20px;">Semua gigi dalam kondisi normal (Sound)</p>
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
                    <div class="date">{{ $odontogram->kunjungan->poli_relation->lokasi ?? 'Kota Sehat' }}, {{ $odontogram->created_at->format('d F Y') }}</div>
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
