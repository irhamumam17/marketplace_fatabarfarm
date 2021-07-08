<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\ProductVariant;


class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'uuid', 'product', 'user_id', 'bank_id', 'transfer_evidence', 'bank_id', 'alamat', 'province_id', 'city_id', 'kodepos', 'nohp', 'ongkir_id', 'kurir', 'berat' ,'note', 'status', 'atas_nama', 'delivered_on', 'canceled_on',
    ];
    protected static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->uuid = Str::orderedUuid()->getHex();
        });
    }
    protected function getProductAttribute($value)
    {
        $field = json_decode($value);
        return $field;
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','uuid');
    }
    public function bank(){
        return $this->belongsTo(Bank::class,'bank_id','uuid');
    }
    public function file_transfer(){
        return $this->belongsTo(File::class,'transfer_evidence','uuid');
    }
    public function ongkir(){
        return $this->belongsTo(Ongkir::class,'ongkir_id','id');
    }
}
