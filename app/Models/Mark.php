<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $fillable = [
        'title'
    ];

    public function pattern() {
        return $this->hasMany(Pattern::class, 'mark_id');
    }
}
