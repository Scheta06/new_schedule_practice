<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    protected $fillable = [
        'title',
        'mark_id',
    ];

    public function mark() {
        return $this->hasMany(Mark::class);
    }

    public function generation() {
        return $this->hasMany(Generation::class, 'pattern_id');
    }
}
