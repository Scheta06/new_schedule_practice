<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extence extends Model
{
    protected $fillable = [
        'title',
        'cost',
        'category_id',
    ];

    public function extenceCategory() {
        return $this->belongsTo(ExtenceCategory::class);
    }

    public function car() {
        return $this->hasMany(Car::class, 'extence_id');
    }
}
