<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInterest extends Model
{
    use HasFactory;
    protected $table = 'user_interests';

    function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function interests()
    {
        return $this->hasMany(Interest::class, 'id', 'interest_id');
    }
}
