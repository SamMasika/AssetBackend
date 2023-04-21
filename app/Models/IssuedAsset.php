<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuedAsset extends Model
{
    use HasFactory;

    protected $table='issued_assets';
    protected $fillable=[
        'staff_id',
        'assets_id',
        'status',
        'condtn',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class,'assets_id','id');
    }
}
