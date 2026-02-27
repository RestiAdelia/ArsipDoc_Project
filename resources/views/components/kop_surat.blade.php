<table width="100%" style="border-bottom: 3px solid black; margin-bottom: 20px;">
    <tr>
        <td width="90">
            @if($instansi && $instansi->logo)
                <img src="{{ public_path('storage/instansi'.$instansi->logo) }}"
                     style="width:80px;">
            @endif
        </td>

        <td style="text-align:center;">
            <h2 style="margin:0; font-weight:bold;">
                {{ $instansi->nama_instansi ?? '-' }}
            </h2>

            <p style="margin:2px 0; font-size:12px;">
                {{ $instansi->alamat ?? '-' }}
            </p>

            <p style="margin:2px 0; font-size:12px;">
                Telp: {{ $instansi->telepon ?? '-' }}
                |
                Email: {{ $instansi->email ?? '-' }}
            </p>
        </td>
    </tr>
</table>