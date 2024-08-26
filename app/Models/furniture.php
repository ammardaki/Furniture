<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Furniture extends Model
{
    use HasFactory;


    //  protected $fillable = [
    //     'name',
    //     'img_url',
    //     'category_id', // تحديث الاسم هنا
    //     'quantity',
    // ];
    protected $fillable = [
        'furniture_id',
        'furniture_name',
        'quantity',
        'img_url'
    ];

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
