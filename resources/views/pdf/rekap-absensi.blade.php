<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Absensi</title>
    <style>
        @page { size: A4 landscape; margin: 15mm 15mm 25mm; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 9pt; color: #333; }
        .header { text-align: center; margin-bottom: 15px; }
        .header h1 { font-size: 15pt; margin: 0 0 3px; }
        .header h2 { font-size: 12pt; margin: 0 0 3px; font-weight: normal; }
        .header p { font-size: 8pt; margin: 2px 0; color: #666; }
        table { width: 100%; border-collapse: collapse; font-size: 7.5pt; }
        th, td { border: 1px solid #999; padding: 3px 4px; text-align: left; }
        th { background: #2563eb; color: #fff; font-weight: 600; text-align: center; }
        tr:nth-child(even) { background: #f1f5f9; }
        .text-center { text-align: center; }
        .badge-hadir { color: #16a34a; font-weight: 600; }
        .badge-terlambat { color: #ca8a04; font-weight: 600; }
        .badge-tidak-hadir { color: #dc2626; font-weight: 600; }
        .stats { margin-top: 15px; text-align: center; }
        .stats .stat { display: inline-block; margin: 0 15px; padding: 8px 20px; border-radius: 4px; }
        .stats .stat-hadir { background: #dcfce7; }
        .stats .stat-terlambat { background: #fef9c3; }
        .stats .stat-tidak-hadir { background: #fee2e2; }
        .stats .stat-value { font-size: 14pt; font-weight: 700; display: block; }
        .stats .stat-label { font-size: 8pt; }
        .footer { position: fixed; bottom: -20mm; left: 0; right: 0; text-align: center; font-size: 7pt; color: #999; }
        .footer .pagenum:before { content: "Halaman " counter(page) " / " counter(pages); }
        .tgl-cetak { font-size: 8pt; color: #666; margin-top: 3px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>SMK Syalafiah Syafiiyah</h1>
        <h2>LAPORAN REKAP ABSENSI</h2>
        @if ($namaGuru)
            <p>Guru: {{ $namaGuru }}</p>
        @endif
        <p class="tgl-cetak">Tanggal Cetak: {{ now()->format('d F Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 16%;">Nama Siswa</th>
                <th style="width: 7%;">Kelas</th>
                <th style="width: 14%;">Mata Pelajaran</th>
                <th style="width: 15%;">Pertemuan</th>
                <th style="width: 10%;">Tanggal</th>
                <th style="width: 9%;">Status</th>
               
            </tr>
        </thead>
        <tbody>
            @forelse ($query as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_siswa }}</td>
                    <td class="text-center">{{ $item->nama_kelas }}</td>
                    <td>{{ $item->nama_mapel }}</td>
                    <td>{{ $item->judul_pertemuan }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                    <td class="text-center">
                        @if ($item->absensi_status === 'hadir')
                            <span class="badge-hadir">Hadir</span>
                        @elseif ($item->absensi_status === 'terlambat')
                            <span class="badge-terlambat">Terlambat</span>
                        @else
                            <span class="badge-tidak-hadir">Tidak Hadir</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center" style="color: #999;">Tidak ada data absensi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>


    <div class="footer">
        <span class="pagenum"></span>
    </div>
</body>
</html>
