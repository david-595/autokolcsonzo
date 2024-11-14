<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rent extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['email', 'car_id', 'rent_start', 'rent_end', 'km', 'all_price'];
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
