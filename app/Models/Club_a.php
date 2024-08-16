<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club_a extends Model
{
     protected $fillable = [
         'user_id','username','ParentId','level','position','name','status',
    ];


      public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    } 
}
