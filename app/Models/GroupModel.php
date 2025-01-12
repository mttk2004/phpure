<?php

namespace App\Models;

use Core\Model;

class GroupModel extends Model
{
    protected string $table = 'groups';

    public function users(): array
    {
        return $this->belongsToMany(
            UserModel::class,
            'group_user',
            'group_id',
            'user_id'
        );
    }
}
