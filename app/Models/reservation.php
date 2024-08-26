<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'furniture_id',
        'date',
        'time',
        'quantity'
    ];
    public function User(){
        return $this->belongsTo('App\Models\User');
    }
    public function furniture(){
        return $this->belongsTo('App\Models\furniture');
    }


}
