<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Score extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_id', 'user_id', 'score'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
