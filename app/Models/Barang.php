<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory; 
    protected $fillable = [
        'no_barang',
        'line_code',
        'chargis_from',
        'chargis_to',
        'shift',
        'info',
    ];
}
