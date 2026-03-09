<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat - {{ $nomor }}</title>
    <style>
        @page {
            margin: 2.5cm 2.5cm 2cm 3cm;
            size: A4 portrait;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            color: #000;
        }
        table { border-collapse: collapse; width: 100%; }
        td { vertical-align: top; }
        p { margin: 0; padding: 0; }

        /* KOP */
        .kop-wrap {
            border-bottom: 4px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .kop-logo { width: 90px; text-align: center; vertical-align: middle; padding-right: 12px; }
        .kop-logo img { height: 80px; width: auto; }
        .kop-text { text-align: center; vertical-align: middle; }
        .kop-instansi { font-size: 16pt; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px; }
        .kop-alamat { font-size: 10pt; line-height: 1.4; }

        /* INFO SURAT */
        .info-surat { margin-bottom: 16pt; }
        .info-surat td.lbl { width: 80px; padding: 1.5pt 0; }
        .info-surat td.sep { width: 12px; padding: 1.5pt 6pt; }
        .info-surat td.val { padding: 1.5pt 0; }

        /* TUJUAN */
        .tujuan { margin-bottom: 16pt; line-height: 1.8; }

        /* ISI */
        .isi-surat { text-align: justify; line-height: 1.8; margin-bottom: 20pt; }

        /* TTD */
        .ttd-wrap { margin-top: 24pt; page-break-inside: avoid; }
        .ttd-kanan { width: 45%; text-align: center; }
        .ttd-space { height: 60pt; }
        .ttd-nama { font-weight: bold; text-decoration: underline; }
    </style>
</head>
<body>

    {{-- KOP SURAT --}}
    <div class="kop-wrap">
        <table>
            <tr>
                <td class="kop-logo">
                    <img src="{{ public_path('storage/instansi/logo.png') }}" alt="Logo">
                </td>
                <td class="kop-text">
                    <p class="kop-instansi">{{ $instansi->nama_instansi ?? 'NAMA INSTANSI' }}</p>
                    <p class="kop-alamat">{{ $instansi->alamat ?? 'Jl. Alamat Instansi No. 1, Kota' }}</p>
                    <p class="kop-alamat">
                        Telp: {{ $instansi->telepon ?? '-' }}&nbsp;&nbsp;|&nbsp;&nbsp;Email: {{ $instansi->email ?? '-' }}
                    </p>
                </td>
            </tr>
        </table>
    </div>

    {{-- NOMOR, SIFAT, LAMPIRAN, PERIHAL + TANGGAL --}}
    <table style="margin-bottom: 16pt;">
        <tr>
            <td style="width: 55%; vertical-align: top;">
                <table class="info-surat">
                    <tr>
                        <td class="lbl">Nomor</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $nomor }}</td>
                    </tr>
                    <tr>
                        <td class="lbl">Sifat</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $sifat ?? 'Biasa' }}</td>
                    </tr>
                    <tr>
                        <td class="lbl">Lampiran</td>
                        <td class="sep">:</td>
                        <td class="val">{{ $lampiran ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="lbl">Perihal</td>
                        <td class="sep">:</td>
                        <td class="val" style="font-weight: bold;">{{ $perihal ?? $template->nama_template }}</td>
                    </tr>
                </table>
            </td>
            <td style="width: 45%; text-align: right; vertical-align: top;">
                {{ $instansi->kota ?? 'Padang' }},
                @if(!empty($dataInput['tanggal']))
                    {{ \Carbon\Carbon::parse($dataInput['tanggal'])->translatedFormat('d F Y') }}
                @else
                    {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                @endif
            </td>
        </tr>
    </table>

    {{-- TUJUAN --}}
    @if(!empty($tujuan))
    <div class="tujuan">
        <p>Kepada Yth.</p>
        <p>{{ $tujuan }}</p>
        <p>di Tempat</p>
    </div>
    @endif

    {{-- ISI SURAT --}}
    <div class="isi-surat">
        {!! $isi !!}
    </div>

    {{-- TANDA TANGAN --}}
    <table class="ttd-wrap">
        <tr>
            <td style="width: 55%;"></td>
            <td class="ttd-kanan">
                <p>Hormat Kami,</p>
                <p>{{ $instansi->jabatan_pimpinan ?? 'Pimpinan' }}</p>
                <div class="ttd-space"></div>
                
            </td>
        </tr>
    </table>

</body>
</html>