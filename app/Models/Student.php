<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Konfigurasi Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class);
    }

    public function parents()
    {
        // return $this->belongsTo(Parents::class);
        return $this->belongsTo(Parents::class, 'parent_id');
    }
}
