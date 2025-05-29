<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'title',
        'user_id',
        'mark_id',
        'extence_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function mark() {
        return $this->belongsTo(Mark::class);
    }

    public function extence() {
        return $this->belongsTo(Extence::class);
    }
}
