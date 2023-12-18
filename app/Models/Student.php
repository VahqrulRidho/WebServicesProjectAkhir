<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'nama_lengkap',
        'nim',
        'prodi',
        'jenis_kelamin',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
