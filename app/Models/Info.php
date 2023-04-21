<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $table='infos';
    protected $fillable=[
        'staff_id',
        'assets_id',
        'condtn_i',
        'condtn',
        'status',
        'status_i',
        'assigned',
       
    ];

     public function asset()
    {
        return $this->belongsTo(Asset::class,'assets_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
