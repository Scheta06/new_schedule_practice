<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtenceCategory extends Model
{
    protected $fillable = [
        'title',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function extence() {
        return $this->hasMany(Extence::class, 'category_id');
    }
}
