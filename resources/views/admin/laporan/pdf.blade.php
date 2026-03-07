<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $judul }}</title>
    <style>
        @page {
            margin: 2.5cm 2.5cm 2cm 3cm;
            size: A4 landscape;
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

        table { border-collapse: collapse; width: 100%; }
        td { vertical-align: top; }
        p { margin: 0; padding: 0; }

        /* ===== KOP ===== */
        .kop-wrap {
            border-bottom: 4px double #000;
            padding-bottom: 10px;
            margin-bottom: 18px;
            width: 100%;
        }

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

        /* ===== JUDUL LAPORAN ===== */
        .judul-wrap {
            text-align: center;
            margin: 16pt 0 4pt 0;
        }

        .judul-wrap h2 {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
            margin: 0 0 4pt 0;
            letter-spacing: 1px;
        }

        .judul-wrap p {
            font-size: 11pt;
            margin: 0;
        }

        .garis-bawah-judul {
            border: none;
            border-top: 1px solid #000;
            margin: 10pt 0;
        }

        /* ===== TABEL DATA ===== */
        .tabel-data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10pt;
            font-size: 11pt;
        }

        .tabel-data thead tr th {
            border: 1px solid #000;
            padding: 5pt 6pt;
            text-align: center;
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .tabel-data tbody tr td {
            border: 1px solid #000;
            padding: 4pt 6pt;
            text-align: left;
            vertical-align: top;
        }

        .tabel-data tbody tr td.center { text-align: center; }
        .tabel-data tbody tr td.right  { text-align: right; }

        .no-data {
            text-align: center;
            padding: 20pt;
            font-style: italic;
        }

        /* ===== TOTAL ROW ===== */
        .total-row td {
            border: 1px solid #000;
            padding: 5pt 6pt;
            font-weight: bold;
            background-color: #f0f0f0;
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

        .ttd-nip { font-size: 11pt; }
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
                        Telp: {{ $instansi->telepon ?? '-' }}&nbsp;&nbsp;|&nbsp;&nbsp;
                        Email: {{ $instansi->email ?? '-' }}
                    </p>
                </td>
            </tr>
        </table>
    </div>

    {{-- JUDUL LAPORAN --}}
    <div class="judul-wrap">
        <h2>{{ $judul }}</h2>
        @if(request('dari') && request('sampai'))
            <p>Periode: {{ date('d F Y', strtotime(request('dari'))) }} s/d {{ date('d F Y', strtotime(request('sampai'))) }}</p>
        @else
            <p>Semua Periode</p>
        @endif
    </div>

    <hr class="garis-bawah-judul">

    {{-- TABEL DATA --}}
    <table class="tabel-data">
        <thead>
            <tr>
                <th width="4%">No</th>

                @if($jenis == 'surat_masuk')
                    <th width="18%">No. Surat</th>
                    <th width="11%">Tanggal</th>
                    <th width="18%">Asal Surat</th>
                    <th width="20%">Instansi</th>
                    <th width="29%">Perihal</th>

                @elseif($jenis == 'surat_keluar')
                    <th width="20%">No. Surat</th>
                    <th width="11%">Tanggal</th>
                    <th width="22%">Tujuan</th>
                    <th width="27%">Perihal</th>
                    <th width="16%">Kategori</th>

                @elseif($jenis == 'arsip')
                    <th width="14%">No. Dokumen</th>
                    <th width="26%">Nama Dokumen</th>
                    <th width="16%">Kategori</th>
                    <th width="13%">Tgl. Dokumen</th>
                    <th width="27%">Keterangan</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $item)

            @php
                $isian = [];
                if ($jenis == 'surat_keluar') {
                    $isian = $item->data_isian;
                    if (is_string($isian)) {
                        $isian = json_decode($isian, true) ?? [];
                    }
                    $isian = $isian ?? [];
                }
            @endphp

            <tr>
                <td class="center">{{ $key + 1 }}</td>

                @if($jenis == 'surat_masuk')
                    <td>{{ $item->nomor_surat ?? '-' }}</td>
                    <td class="center">{{ $item->tanggal_surat ? date('d-m-Y', strtotime($item->tanggal_surat)) : '-' }}</td>
                    <td>{{ $item->asal_surat ?? '-' }}</td>
                    <td>{{ $item->instansi ?? '-' }}</td>
                    <td>{{ $item->perihal ?? '-' }}</td>

                @elseif($jenis == 'surat_keluar')
                    <td>{{ $item->nomor_surat ?? '-' }}</td>
                    <td class="center">
                        {{ isset($isian['tanggal']) ? date('d-m-Y', strtotime($isian['tanggal'])) : date('d-m-Y', strtotime($item->created_at)) }}
                    </td>
                    <td>{{ $isian['tujuan'] ?? '-' }}</td>
                    <td>{{ $isian['perihal'] ?? '-' }}</td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>

                @elseif($jenis == 'arsip')
                    <td>{{ $item->nomor_dokumen ?? '-' }}</td>
                    <td>{{ $item->nama_dokumen ?? '-' }}</td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td class="center">{{ $item->tanggal_dokumen ? date('d-m-Y', strtotime($item->tanggal_dokumen)) : '-' }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                @endif
            </tr>

            @empty
            <tr>
                <td colspan="6" class="no-data">Data tidak ditemukan pada periode ini.</td>
            </tr>
            @endforelse

            {{-- BARIS TOTAL DATA --}}
            @if($data->count() > 0)
            <tr class="total-row">
                <td colspan="5" style="text-align: right;">Total Data</td>
                <td class="center">{{ $totalData }} data</td>
            </tr>
            @endif

        </tbody>
    </table>

    {{-- TANDA TANGAN --}}
    <table class="ttd-wrap">
        <tr>
            <td class="ttd-kiri"></td>
            <td class="ttd-kanan">
                <p>{{ $instansi->kota ?? 'Padang' }}, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <br>
                <p>{{ $instansi->jabatan_pimpinan ?? 'Pimpinan' }}</p>
                <span class="ttd-space"></span>
                <p class="ttd-nama">{{ $instansi->nama_pimpinan ?? '(Nama Pimpinan)' }}</p>
                <p class="ttd-nip">NIP. {{ $instansi->nip_pimpinan ?? '-' }}</p>
            </td>
        </tr>
    </table>

</body>
</html>