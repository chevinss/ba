<?php

namespace App\Services;
use App\Models\User;
use App\Models\Student;

class ParentServices
{
    public static function siswa($params)
    {
        $student = Student::where('parent_id', $params)->get();
        return $student;
    }

    public static function detailSiswa($params)
    {
        $student = Student::where('id', $params)->with('pengaduan')->first();
        return $student;
    }
}

?>
