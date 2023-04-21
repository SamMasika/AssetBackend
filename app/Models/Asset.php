<?php

namespace App\Models;


use App\Models\Asset;
use App\Enums\AssetCategoryEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;

    protected $table='assets';
    protected $fillable=[
        'name',
        'user_id',
        'status',
        'flug',
        'control',
        'purchase_date',
        'category',
        'barcodes',
        'asset_code',
         'uta',
         'manufactured_year',
         'uta',
         'p_price'
    ];

    // protected $casts = [
    //     'category' => AssetCategoryEnum::class
    // ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function office()
    {
        return $this->belongsTo(Office::class,'office_id','id');
    }

    public function calculatePercentage()
{
    
    $totalValue = Asset::sum('status');
    if ($totalValue == 0) {
        return 0;
    }
    return ($this->value / $totalValue) * 100;
}

}
