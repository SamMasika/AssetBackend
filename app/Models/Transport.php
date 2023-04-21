<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    protected $table='transports';
    protected $fillable=[
        'assets_id',
        'transport_type',
        'cheses_no',
        'reg_no',
        'engine_capacity',
        'brand',
        'model',
    ];
}
