<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    /*Connexion Quiz et Score*/
    use HasFactory;

    protected $fillable = ['title', 'description'];
    protected $appends = ['image_url', 'duration'];

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    /*Connexion Quiz et Questions*/
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    /*Connexion Quiz et Catégories*/
    public function category(): BelongsTo
    {
        return $this->belongsTo(QuizCategory::class);
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/'.$this->image);
    }
    public function getDurationAttribute()
    {
        return round($this->questions()->sum('duration') / 60);
    }
}
