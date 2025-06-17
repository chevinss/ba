<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengaduanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Pengaduan::with(['student','tanggapan'])->get()->map(function ($pengaduan, $index){
            return [
                'no' => $index + 1,
                'nisn' => "'".$pengaduan->student->nisn ?? '',
                'nama' => $pengaduan->student->nama ?? '',
                'isi_pengaduan' => $pengaduan->isi_laporan,
                'tanggal_pengaduan' => $pengaduan->tanggal,
                'isi_tanggapan' => $pengaduan->tanggapan->isi_tanggapan ?? 'Belum Ditanggapi',
                'tanggal_tanggapan' => $pengaduan->tanggapan->tanggal ?? 'Belum Ditanggapi',
                'status' => $pengaduan->status === 's' ? 'Belum Ditanggapi' : ($pengaduan->status === 'p' ? 'Sedang Di Proses' : 'Selesai')
            ];
        });
        return $data;
    }

    public function headings() : array
    {
        return ['No','NISN','Nama','Isi Pengaduan','Tanggal Pengaduan','Isi Tanggapan','Tanggal Tanggapan','Status'];
    }
}
