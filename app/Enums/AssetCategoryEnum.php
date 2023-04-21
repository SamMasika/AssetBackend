<?php

namespace App\Enums;
enum AssetCategoryEnum:String
{
    case ELECTRONIC = 'ELECTRONIC';
    case FURNITURE = 'FURNITURE';
    case BUILDING = 'BUILDING';
    case TRANSPORT = 'TRANSPORT';
    public static function values():array
    {
        return array_column(self::cases(),'name','value');
    }
}
