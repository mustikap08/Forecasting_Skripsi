<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktual extends Model
{
    use HasFactory;

    protected $table = 'aktual';

    protected $fillable = [
        'kategori_id',
        'bulan',
        'financial_year',
        'chain',
        'subrub',
        // 'state',
        // 'country',
        'sales',
    ];

     // Definisikan relasi inverse untuk mendapatkan kategori dari data aktual
     public function kategori()
     {
         return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
     }
}
