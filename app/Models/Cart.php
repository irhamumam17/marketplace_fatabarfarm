<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'uuid', 'product_varian_id', 'user_id', 'amount'
    ];

    public function product_variant(){
        return $this->belongsTo(ProductVariant::class,'product_varian_id','uuid');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','uuid');
    }
}
