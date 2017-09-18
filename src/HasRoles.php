<?php

namespace Codecourse\Roles;

trait HasRoles
{
    /**
     * User's roles.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * If the user has the given role.
     *
     * @param  string  $role
     * @return boolean
     */
    public function hasRole($role)
    {
        return $this->roles->contains('title', $role);
    }
}
