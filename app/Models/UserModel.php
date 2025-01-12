<?php

namespace App\Models;

use Core\Model;

class UserModel extends Model
{
    protected string $table = 'users';

    public function profile()
    {
        return $this->hasOne(ProfileModel::class, 'user_id');
    }
}
