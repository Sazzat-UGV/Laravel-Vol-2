<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded=['id'];

    /*relationship with user*/
    Public function user(){
        return $this->hasMany(User::class);
    }

    /*relationship with permission */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
