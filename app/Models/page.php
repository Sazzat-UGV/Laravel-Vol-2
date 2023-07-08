<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class page extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded=['id'];


    //Static Method for finding page details using slug
    public static function findBySlug($page_slug){
        return self::where('slug',$page_slug)->where('is_active',1)->firstOrFail();
    }

}
