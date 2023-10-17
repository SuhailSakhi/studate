<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
//    public mixed $user_id;
    protected ?int $user_id;

    protected $fillable = ['image', 'name', 'gender', 'age', 'bio'];
}



