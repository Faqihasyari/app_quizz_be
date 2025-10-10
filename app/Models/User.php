<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use  HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Fungsi untuk update peringkat user berdasarkan jumlah jawaban benar.
     */
    public function updateRank()
    {
        $correctAnswers = $this->correct_answers_count ?? 0;

        if ($correctAnswers < 5) {
            $this->rank = 'Beginner';
        } elseif ($correctAnswers < 10) {
            $this->rank = 'Intermediate';
        } elseif ($correctAnswers < 20) {
            $this->rank = 'Advanced';
        } elseif ($correctAnswers < 50) {
            $this->rank = 'Expert';
        } else {
            $this->rank = 'Master';
        }

        $this->save();
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
