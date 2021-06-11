<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type',
        'content',
        'validity_period'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','uuid');
    }
}
