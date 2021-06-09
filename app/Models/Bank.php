<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid', 'name', 'account_number', 'logo', 'saldo'
    ];

    public function logo(){
        return $this->belongsTo(File::class,'logo','uuid');
    }
}
