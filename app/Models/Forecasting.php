<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forecasting extends Model
{
    use HasFactory;

    protected $table = 'forecasting';

    protected $fillable = [
        'x',
        'y',
        'x_squared',
        'y_squared',
        'date',
    ];
}
