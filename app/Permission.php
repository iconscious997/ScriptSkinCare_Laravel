<?php

namespace App;

class Permission extends Model
{
    public function roles()
    {
    	return $this->belongsToMany(Role::class);
    }
}
