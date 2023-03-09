<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';

    public function interest_ids()
    {
        return $this->hasMany(UserInterest::class, 'user_id', 'id');
    }

}
