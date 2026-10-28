<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Assessment extends Model
{
    protected $fillable = ['user_id', 'career_target_id', 'score'];

    public function answers(): HasMany
    {
        return $this->hasMany(AssessmentAnswer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function careerTarget(): BelongsTo
    {
        return $this->belongsTo(CareerTarget::class);
    }
}

