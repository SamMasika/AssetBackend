<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintainance extends Model
{
    use HasFactory;

    protected $table='maintainances';
    protected $fillable=[
        'assets_id',
        'condtn',
        
        
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class,'assets_id','id');
    }
}
