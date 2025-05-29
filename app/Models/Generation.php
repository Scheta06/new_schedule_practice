<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    protected $fillable = [
        'title',
        'pattern_id',
    ];

    public function pattern() {
        return $this->belongsTo(Pattern::class);
    }
}
