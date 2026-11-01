<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CareerTarget extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'icon'];

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'career_target_skill')->withPivot('required_level')->withTimestamps();
    }

    public function learningResources(): HasMany
    {
        return $this->hasMany(LearningResource::class);
    }
}
