<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class profile extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'name', 'gender', 'age', 'bio', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedByAuthUser()
    {
        // Haal de huidige ingelogde gebruiker op
        $user = Auth::user();

        // Controleer of er een like is van de huidige gebruiker voor dit profiel
        return $this->likes->contains('user_id', $user->id);
    }

}


