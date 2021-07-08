<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'uuid', 'title', 'image', 'content', 'status'
    ];
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
}
