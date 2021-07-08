<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bank extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid', 'name', 'account_number'
    ];

    public function logo(){
        return $this->belongsTo(File::class,'logo','uuid');
    }
    protected static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->uuid = Str::orderedUuid()->getHex();
        });
    }
}
