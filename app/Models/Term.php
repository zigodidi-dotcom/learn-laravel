<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Term extends Model
{
    protected $fillable = ['name', 'slug', 'definition'];

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class);
    }
}
