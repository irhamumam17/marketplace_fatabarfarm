<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid', 'path'
    ];
    public function userImage(){
        return $this->hasOne(User::class,'image');
    }
    public function bankImage(){
        return $this->hasOne(Bank::class,'logo');
    }
    public function transactionImage(){
        return $this->hasOne(Transaction::class,'transfer_evidence');
    }
    protected static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->uuid = Str::orderedUuid()->getHex();
        });
    }
}
