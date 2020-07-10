<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'users_roles';
    protected $guarded = ['id', 'isAdmin'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
