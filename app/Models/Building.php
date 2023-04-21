<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $table='buildings';
    protected $fillable=[
        'assets_id',
        'size',
       'purpose',
       'floor_no',
       'no_of_rooms',
      
    ];
}
