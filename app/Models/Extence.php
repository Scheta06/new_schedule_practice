<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extence extends Model
{
    protected $fillable = [
        'title',
        'cost',
        'category_id',
        'user_id',
        'car_id'
    ];

    public function extenceCategory() {
        return $this->belongsTo(ExtenceCategory::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function car() {
        return $this->belongsTo(Car::class);
    }
}
