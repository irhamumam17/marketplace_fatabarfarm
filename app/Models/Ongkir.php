<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ongkir extends Model
{
    use HasFactory;
    protected $fillable = [
        'service', 'description', 'cost_value', 'cost_etd', 'cost_note'
    ];
}
