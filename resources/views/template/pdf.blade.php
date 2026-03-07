<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat - {{ $nomor }}</title>
    <style>
        @page { margin: 2.5cm 2.5cm 2cm 3cm; size: A4 portrait; }
        * { box-sizing: border-box; }
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.5; margin: 0; padding: 0; }
        table { border-collapse: collapse; }
        td { vertical-align: top; }
        p { margin: 0; padding: 0; }
        
        /* Styles KOP dan elemen lain dari kode asli Anda */
        .kop-wrap { border-bottom: 4px double #000; padding-bottom: 10px; margin-bottom: 18px; width: 100%; }
        .kop-table { width: 100%; }
        .kop-logo { width: 90px; text-align: center; }
        .kop-logo img { height: 80px; width: auto; }
        .kop-text { text-align: center; }
        .kop-instansi { font-size: 16pt; font-weight: bold; text-transform: uppercase; }
        .kop-alamat { font-size: 10pt; }
        
        .info-surat { width: 100%; margin-bottom: 14pt; }
        .ttd-wrap { width: 100%; margin-top: 24pt; page-break-inside: avoid; }
        .ttd-kanan { width: 45%; text-align: center; float: right; }
        .ttd-nama { font-weight: bold; text-decoration: underline; }
    </style>
</head>
<body>
    {{-- KOP SURAT --}}
    <div class="kop-wrap">
        <table class="kop-table">
            <tr>
                <td class="kop-logo"><img src="{{ public_path('storage/instansi/logo.png') }}" alt="Logo"></td>
                <td class="kop-text">
                    <p class="kop-instansi">{{ $instansi->nama_instansi ?? 'NAMA INSTANSI' }}</p>
                    <p class="kop-alamat">{{ $instansi->alamat ?? 'Alamat...' }}</p>
                </td>
            </tr>
        </table>
    </div>

    {{-- ISI SURAT SESUAI FORMAT --}}
    <table style="width: 100%; margin-bottom: 20px;">
        <tr>
            <td style="width: 100px;">Nomor</td><td>:</td><td>{{ $nomor }}</td>
        </tr>
        <tr>
            <td>Sifat</td><td>:</td><td>{{ $sifat ?? 'Biasa' }}</td>
        </tr>
        <tr>
            <td>Lampiran</td><td>:</td><td>{{ $lampiran ?? '-' }}</td>
        </tr>
        <tr>
            <td>Perihal</td><td>:</td><td><b>{{ $perihal ?? $template->nama_template }}</b></td>
        </tr>
    </table>

    <div style="margin-bottom: 20px;">
        <p>Yth. {{ $tujuan ?? '...' }}</p>
        <p>di {{ $tempat ?? 'Tempat' }}</p>
    </div>

    <div class="isi-surat" style="text-align: justify;">
        {!! $pembuka ?? $isi !!}
    </div>

    {{-- TANDA TANGAN --}}
    <table class="ttd-wrap">
        <tr>
            <td style="width: 50%;"></td>
            <td class="ttd-kanan">
                <p>{{ $instansi->kota ?? 'Tempat' }}, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p>Hormat Kami,</p>
                <p>{{ $instansi->jabatan_pimpinan ?? 'Pimpinan' }}</p>
                <br><br><br>
                <p class="ttd-nama">{{ $instansi->nama_pimpinan ?? '(Nama)' }}</p>
                <p>NIP. {{ $instansi->nip_pimpinan ?? '-' }}</p>
            </td>
        </tr>
    </table>
</body>
</html>