<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_chapter',
        'judul',
        'deskripsi',
        'modul',
        'video',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'id_chapter');
    }
}
