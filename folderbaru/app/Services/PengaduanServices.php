<?php

namespace App\Services;
use App\Models\Pengaduan;


class PengaduanServices
{
    public static function list()
    {
        $data = Pengaduan::all();
        return $data;
    }

    public static function listSiswa($params)
    {
        $data = Pengaduan::where('student_id', $params)->get();
        return $data;
    }

    public static function detail($id)
    {
        $data = Pengaduan::where('id', $id)->first();
        return $data;
    }


}

?>
