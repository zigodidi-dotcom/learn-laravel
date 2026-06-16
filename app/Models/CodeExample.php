<?php

namespace App\Models;

use App\Enums\CodeLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CodeExample extends Model
{
    protected $fillable = ['feature_id', 'title', 'code', 'language', 'description'];

    protected $casts = [
        'language' => CodeLanguage::class,
    ];

    public function feature(): BelongsTo
    {
        return $this->belongsTo(Feature::class);
    }
}
