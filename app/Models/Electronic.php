<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electronic extends Model
{
    use HasFactory;
    protected $table='electronics';
    protected $fillable=[
        'assets_id',
        'chapa',
        'modeli',
        'serial_no',
    ];
}
