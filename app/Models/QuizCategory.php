<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizCategory extends Model
{
    protected $appends = ['image_url'];

    public function quiz(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/'.$this->image);
    }
}
