<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ProductVariant extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'uuid', 'product_id', 'detail', 'price', 'stock', 'image'
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','uuid');
    }
    public function file(){
        return $this->belongsTo(File::class,'image','uuid');
    }
    protected function getDetailAttribute($value)
    {
        return json_decode($value);
    }
    protected static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->uuid = Str::orderedUuid()->getHex();
        });
    }
}
