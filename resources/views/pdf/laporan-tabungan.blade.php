<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Tabungan</title>
    <style>
        @page { size: A4 landscape; margin: 20mm 15mm 25mm; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10pt; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { font-size: 16pt; margin: 0 0 4px; }
        .header p { font-size: 9pt; margin: 2px 0; color: #666; }
        table { width: 100%; border-collapse: collapse; font-size: 8.5pt; }
        th, td { border: 1px solid #999; padding: 4px 5px; text-align: left; }
        th { background: #2563eb; color: #fff; font-weight: 600; text-align: center; }
        tr:nth-child(even) { background: #f1f5f9; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .setor { color: #16a34a; font-weight: 600; }
        .tarik { color: #dc2626; font-weight: 600; }
        .ringkasan { margin-top: 15px; font-size: 9pt; }
        .ringkasan table { width: auto; }
        .ringkasan th { background: transparent; color: #333; border: none; text-align: right; padding: 2px 10px; }
        .ringkasan td { border: none; padding: 2px 10px; }
        .footer { position: fixed; bottom: -20mm; left: 0; right: 0; text-align: center; font-size: 8pt; color: #999; }
        .footer .pagenum:before { content: "Halaman " counter(page) " / " counter(pages); }
        .tgl-cetak { font-size: 9pt; color: #666; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN TABUNGAN SISWA</h1>
        <p>SMKS Salafiyah Syafi'iyah</p>
        <p class="tgl-cetak">Tanggal Cetak: {{ now()->format('d F Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 10%;">Tanggal</th>
                <th style="width: 8%;">NIS</th>
                <th style="width: 18%;">Nama Siswa</th>
                <th style="width: 8%;">Kelas</th>
                <th style="width: 8%;">Jenis</th>
                <th style="width: 14%;">Nominal</th>
                <th style="width: 18%;">Keterangan</th>
                <th style="width: 12%;">Admin</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksiList as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $item->tanggal->format('d/m/Y') }}</td>
                    <td class="text-center">{{ $item->tabungan->siswa->nis ?? '-' }}</td>
                    <td>{{ $item->tabungan->siswa->name }}</td>
                    <td class="text-center">{{ $item->tabungan->siswa->kelas->nama_kelas ?? '-' }}</td>
                    <td class="text-center {{ $item->jenis === 'setor' ? 'setor' : 'tarik' }}">
                        {{ $item->jenis === 'setor' ? 'Setoran' : 'Penarikan' }}
                    </td>
                    <td class="text-right">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                    <td>{{ $item->admin->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center" style="color: #999;">Tidak ada data transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="ringkasan">
        <table>
            <tr>
                <th>Total Setoran</th>
                <td>Rp {{ number_format($totalSetor, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Total Penarikan</th>
                <td>Rp {{ number_format($totalTarik, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Saldo Akhir</th>
                <td>Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <span class="pagenum"></span>
    </div>
</body>
</html>
