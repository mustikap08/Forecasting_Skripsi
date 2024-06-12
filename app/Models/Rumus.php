<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rumus extends Model
{
    use HasFactory;

    protected $table ='rumus';

    protected $fillable = [
        'n',
        'ey',
        'ex',
        'exy',
        'ex2',
        'ex_square',
    ];
}
