<?php

namespace App\Models;

use App\Enums\Difficulty;
use App\Enums\FeatureType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Feature extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'since_version', 'difficulty', 'type',
    ];

    protected $casts = [
        'difficulty' => Difficulty::class,
        'type'       => FeatureType::class,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function terms(): BelongsToMany
    {
        return $this->belongsToMany(Term::class);
    }

    public function examples(): HasMany
    {
        return $this->hasMany(CodeExample::class);
    }
}
