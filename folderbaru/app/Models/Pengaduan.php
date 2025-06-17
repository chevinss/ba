<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Konfigurasi Relasi
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class);
    }
}
