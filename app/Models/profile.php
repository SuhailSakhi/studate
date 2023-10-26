<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class profile extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'name', 'gender', 'age', 'bio', 'user_id']; // Geef aan welke velden ingevuld mogen worden

    public function user()
    {
        return $this->belongsTo(User::class); // Een profiel hoort bij een gebruiker
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'profile_id');
    }
}


