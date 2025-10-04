<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'created_by',
    ];

    public function category()
{
    return $this->belongsTo(Category::class);
}

    // Relasi ke User (pembuat kuis)
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi ke Questions
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
