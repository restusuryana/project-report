<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory; 
    protected $fillable = [
        'no_barang',
        'line_code',
        'chargis_from',
        'chargis_to',
        'shift',
        'info',
        'user_id',
        'tanggal_susun',
    ];
}
