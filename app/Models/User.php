<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $table = 'users';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
     
    public function roles(){
        return $this->belongsTo('App\Models\roles');
   
    }
    public function Evaluation(){
        return $this->belongsTo('App\Models\Evaluation');
    }
    public function reservation(){
        return $this->hasMany('App\Models\reservation');
    }
    public function Comment(){
        return $this->hasMany('App\Models\Comment');
    }
    public function sendPasswordResetNotification($token)
    {
        // حذف إشعارات إعادة تعيين كلمة المرور القديمة للمستخدم الحالي
        $this->notifications()->where('type', ResetPasswordNotification::class)->delete();
    
        $url = 'https://spa.test/reset-password?token=' . $token;
    
        $this->notify(new ResetPasswordNotification($url));
    }
    

}
