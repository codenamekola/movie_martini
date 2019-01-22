<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;

class Review extends Model
{
    protected $fillable = ['name','remark','stars'];
    
    public function movie(){

        return $this->belongsTo(Movie::class);
    }
}
