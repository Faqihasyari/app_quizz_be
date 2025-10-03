<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question_text',
    ];

    // Relasi ke Quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Relasi ke Answer
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
