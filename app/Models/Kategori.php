<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'kategori',
        'keterangan',
    ];

     // Definisikan relasi one-to-many dengan model Aktual
     public function aktuals()
     {
         return $this->hasMany(Aktual::class);
     }
}
