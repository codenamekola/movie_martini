<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\User;

class Movie extends Model
{
    protected $fillable = ['name','lead_actor','description','genre'];
    
    public function reviews(){

        return $this->hasMany(Review::class);
    }

    public function user(){

        return $this->belongsTo(User::class);
    }
}
