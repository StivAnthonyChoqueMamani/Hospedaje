<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bedroom extends Model
{
    use HasFactory;

    protected $fillable = ['nro', 'nro_beds', 'size_beds', 'floor', 'price', 'is_bath'];

    public static function get_enum_values_size_beds()
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM bedrooms WHERE FIELD = 'size_beds'"))[0]->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }
    
}
