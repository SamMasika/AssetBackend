<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposal extends Model
{
    use HasFactory;

    protected $table='disposals';
    protected $fillable=[
        'assets_id',
        'condtn_m',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class,'assets_id','id');
    }
}
