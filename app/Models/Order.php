<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';
    protected $fillable=[
        'assets_id',
        'user_id',
        'depart_id',
        'status',
        'remark',
      
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class,'assets_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class,'depart_id','id');
    }
}
