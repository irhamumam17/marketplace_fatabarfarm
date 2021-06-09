<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'uuid', 'product_id', 'user_id', 'bank_id', 'transfer_evidence', 'amount', 'status'
    ];
    public function product_variant(){
        return $this->belongsTo(ProductVariant::class,'product_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function bank(){
        return $this->belongsTo(Bank::class,'bank_id');
    }
    public function file_transfer(){
        return $this->belongsTo(File::class,'transfer_evidence');
    }
}
