<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLearningProgress extends Model
{
     protected $fillable = ['user_id', 'learning_resource_id', 'completed', 'completed_at'];

    protected function casts(): array
    {
        return ['completed' => 'boolean', 'completed_at' => 'datetime'];
    }

    public function resource(): BelongsTo
    {
        return $this->belongsTo(LearningResource::class, 'learning_resource_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
