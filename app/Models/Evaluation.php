<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'furniture_id',
        'value'
    ];

    public function User(){
        return $this->hasMany('App\Models\User');
    }
    public function furniture(){
        return $this->belongsTo('App\Models\furniture');
    }

}
