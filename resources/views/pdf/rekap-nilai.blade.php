<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Nilai</title>
    <style>
        @page { size: A4 portrait; margin: 20mm 15mm 25mm; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10pt; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { font-size: 16pt; margin: 0 0 4px; }
        .header h2 { font-size: 13pt; margin: 0 0 4px; font-weight: normal; }
        .header p { font-size: 9pt; margin: 2px 0; color: #666; }
        table { width: 100%; border-collapse: collapse; font-size: 8.5pt; }
        th, td { border: 1px solid #999; padding: 4px 5px; text-align: left; }
        th { background: #2563eb; color: #fff; font-weight: 600; text-align: center; }
        tr:nth-child(even) { background: #f1f5f9; }
        .text-center { text-align: center; }
        .badge-dinilai { color: #16a34a; font-weight: 600; }
        .badge-menunggu { color: #ca8a04; font-weight: 600; }
        .badge-draft { color: #6b7280; }
        .footer { position: fixed; bottom: -20mm; left: 0; right: 0; text-align: center; font-size: 8pt; color: #999; }
        .footer .pagenum:before { content: "Halaman " counter(page) " / " counter(pages); }
        .ringkasan { margin-top: 15px; font-size: 9pt; }
        .ringkasan strong { display: inline-block; margin-right: 20px; }
        .tgl-cetak { font-size: 9pt; color: #666; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN REKAP NILAI</h2>
        @if ($namaGuru)
            <p>Guru: {{ $namaGuru }}</p>
        @endif
        <p class="tgl-cetak">Tanggal Cetak: {{ now()->format('d F Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 18%;">Nama Siswa</th>
                <th style="width: 8%;">Kelas</th>
                <th style="width: 13%;">Mata Pelajaran</th>
                <th style="width: 18%;">Tugas</th>
                <th style="width: 9%;">Nilai PG</th>
                <th style="width: 9%;">Nilai Essay</th>
                <th style="width: 9%;">Nilai Akhir</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($query as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_siswa }}</td>
                    <td class="text-center">{{ $item->nama_kelas }}</td>
                    <td>{{ $item->nama_mapel }}</td>
                    <td>{{ $item->tugas_judul }}</td>
                    <td class="text-center">{{ $item->nilai_pg ?? '-' }}</td>
                    <td class="text-center">{{ $item->nilai_essay ?? '-' }}</td>
                    <td class="text-center">
                        @if ($item->jawaban_status === 'dinilai')
                            <strong>{{ $item->nilai_akhir }}</strong>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center" style="color: #999;">Tidak ada data nilai.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <span class="pagenum"></span>
    </div>
</body>
</html>
