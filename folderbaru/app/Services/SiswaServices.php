<?php

namespace App\Services;
use App\Models\User;
use App\Models\Student;

class SiswaServices
{
    public static function list()
    {
        $siswa = User::where('role','siswa')->whereHas('student')
        ->with('student.parents')
        ->get();
        return $siswa;
    }
}

?>
