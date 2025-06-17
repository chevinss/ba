<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Laporan Pengaduan Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            width: 90%;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            margin-bottom: 10px;
            color: #555;
        }

        .section p {
            margin: 5px 0;
            color: #666;
        }

        .divider {
            border-top: 2px solid #ddd;
            margin: 20px 0;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #999;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Laporan Pengaduan dan Tanggapan</h1>

        <div class="section">
            <h2>Pengaduan</h2>
            <p><strong>Isi Pengaduan:</strong> {{ $data->isi_laporan }}</p>
            <p><strong>Tanggal Pengaduan:</strong> {{ $data->tanggal }}</p>
        </div>

        <div class="divider"></div>

        <div class="section">
            <h2>Tanggapan</h2>
            <p><strong>Isi Tanggapan:</strong> {{ $data->tanggapan ? $data->tanggapan->isi_tanggapan : 'Belum Ditanggapi' }}</p>
            <p><strong>Tanggal Tanggapan:</strong> {{ $data->tanggapan ? $data->tanggapan->tanggal : 'Belum Ditanggapi' }}</p>
        </div>

        <div class="divider"></div>

        <div class="section">
            <h2>Bukti Pengaduan</h2>
            @if ($data->type != 'photo')
                <p>Bukti Pengaduan Berupa {{ ucfirst($data->type) }} Silahkan Cek Didalam detail pengaduan yang ada di sistem informasi</p>
            @else
                <img src="{{ public_path($data->path) }}" alt="gambar rusak" style="width: 100%">
            @endif
        </div>
    </div>
</body>
</html>
