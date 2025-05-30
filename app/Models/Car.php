<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'title',
        'user_id',
        'mark_id',
        'pattern_id',
        'generation_id',
    ];

    public function extence() {
        return $this->hasMany(Extence::class, 'car_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function mark() {
        return $this->belongsTo(Mark::class);
    }

    public function pattern() {
        return $this->belongsTo(Pattern::class);
    }

    public function generation() {
        return $this->belongsTo(Generation::class);
    }
}
