<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'uuid', 'category_id', 'name', 'detail'
    ];

    public function category(){
        return $this->belongsTo(ProductCategory::class,'category_id');
    }
    public function variant(){
        return $this->hasMany(ProductVariant::class,'product_id','uuid');
    }
    protected static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->uuid = Str::orderedUuid()->getHex();
        });
    }
}
