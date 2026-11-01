<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LearningResource extends Model
{
    protected $fillable = ['career_target_id', 'skill_id', 'title', 'description', 'url', 'level', 'sequence'];

    public function careerTarget(): BelongsTo
    {
        return $this->belongsTo(CareerTarget::class);
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }

    public function userProgress(): HasMany
    {
        return $this->hasMany(UserLearningProgress::class);
    }
}

