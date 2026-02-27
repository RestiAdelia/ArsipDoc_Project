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
            line-height: 1.5;
            color: #000;
            margin: 0;
            padding: 0;
        }

        table { border-collapse: collapse; }
        td { vertical-align: top; }
        p { margin: 0; padding: 0; }

        /* ===== KOP ===== */
        .kop-wrap {
            border-bottom: 4px double #000;
            padding-bottom: 10px;
            margin-bottom: 18px;
            width: 100%;
        }

        .kop-table { width: 100%; }

        .kop-logo {
            width: 90px;
            text-align: center;
            vertical-align: middle;
            padding-right: 10px;
        }

        .kop-logo img {
            height: 80px;
            width: auto;
        }

        .kop-text {
            text-align: center;
            vertical-align: middle;
        }

        .kop-instansi {
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 0 2px 0;
        }

        .kop-alamat {
            font-size: 10pt;
            margin: 0;
            line-height: 1.4;
        }

        /* ===== INFO SURAT ===== */
        .info-surat {
            width: 100%;
            margin-bottom: 14pt;
        }

        .info-surat td {
            font-size: 12pt;
            padding: 1.5pt 0;
        }

        .col-label { width: 12%; }
        .col-sep   { width: 2%; }
        .col-value { width: 86%; }

        /* ===== TANGGAL ===== */
        .tanggal-wrap {
            width: 100%;
            margin-bottom: 14pt;
        }

        /* ===== ISI ===== */
        .isi-surat {
            font-size: 12pt;
            line-height: 1.6;
            text-align: justify;
            margin-bottom: 10pt;
        }

        .isi-surat p {
            margin: 0 0 6pt 0;
        }

        /* ===== TTD ===== */
        .ttd-wrap {
            width: 100%;
            margin-top: 24pt;
            page-break-inside: avoid;
        }

        .ttd-kiri { width: 55%; }

        .ttd-kanan {
            width: 45%;
            text-align: center;
            font-size: 12pt;
            line-height: 1.6;
        }

        .ttd-space {
            display: block;
            height: 60pt;
        }

        .ttd-nama {
            font-weight: bold;
            text-decoration: underline;
        }

        .ttd-nip {
            font-size: 11pt;
        }
    </style>
</head>
<body>

    {{-- KOP SURAT --}}
    <div class="kop-wrap">
        <table class="kop-table">
            <tr>
                <td class="kop-logo">
                    <img src="{{ public_path('storage/instansi/logo.png') }}" alt="Logo">
                </td>
                <td class="kop-text">
                    <p class="kop-instansi">{{ $instansi->nama_instansi ?? 'NAMA INSTANSI' }}</p>
                    <p class="kop-alamat">{{ $instansi->alamat ?? 'Jl. Alamat Instansi No. 1, Kota' }}</p>
                    <p class="kop-alamat">
                        Telp: {{ $instansi->telepon ?? '-' }}&nbsp;&nbsp;|&nbsp;&nbsp;
                        Email: {{ $instansi->email ?? '-' }}
                    </p>
                </td>
            </tr>
        </table>
    </div>

    {{-- INFO SURAT + TANGGAL (sejajar) --}}
    <table class="tanggal-wrap">
        <tr>
            {{-- Kiri: Nomor & Perihal --}}
            <td style="width:55%; vertical-align:top;">
                <table class="info-surat">
                    <tr>
                        <td class="col-label">Nomor</td>
                        <td class="col-sep">:</td>
                        <td class="col-value">{{ $nomor }}</td>
                    </tr>
                    <tr>
                        <td class="col-label">Perihal</td>
                        <td class="col-sep">:</td>
                        <td class="col-value"><strong>{{ $template->nama_template }}</strong></td>
                    </tr>
                </table>
            </td>

            {{-- Kanan: Tempat & Tanggal --}}
            <td style="width:45%; text-align:right; vertical-align:top; font-size:12pt;">
                {{ $instansi->kota ?? 'Padang' }}, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </td>
        </tr>
    </table>

    {{-- ISI SURAT --}}
    <div class="isi-surat">
        {!! $isi !!}
    </div>

    {{-- TANDA TANGAN --}}
    <table class="ttd-wrap">
        <tr>
            <td class="ttd-kiri"></td>
            <td class="ttd-kanan">
                <p>Hormat Kami,</p>
                <p>{{ $instansi->jabatan_pimpinan ?? 'Pimpinan' }}</p>
                <span class="ttd-space"></span>
                <p class="ttd-nama">{{ $instansi->nama_pimpinan ?? '(Nama Pimpinan)' }}</p>
                <p class="ttd-nip">NIP. {{ $instansi->nip_pimpinan ?? '-' }}</p>
            </td>
        </tr>
    </table>

</body>
</html>