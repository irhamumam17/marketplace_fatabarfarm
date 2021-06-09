<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Str;
use App\Models\File;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'fcm_token',
        'role',
        'address',
        'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $attributes = [
        'role' => 'customer',
    ];
    protected function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
    protected static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->uuid = Str::orderedUuid()->getHex();
        });
    }
    public function file(){
        return $this->belongsTo(File::class,'image','uuid');
    }
    public function cart(){
        return $this->hasMany(Cart::class);
    }
    public function chat(){
        return $this->hasMany(Chat::class);
    }
    public function transaction(){
        return $this->hasMany(Transaction::class);
    }
}
