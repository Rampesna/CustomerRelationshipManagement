<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleService
{
    private $role;

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @param Role $role
     */
    public function setRole(Role $role): void
    {
        $this->role = $role;
    }

    public function save(Request $request)
    {
        $this->role->name = $request->name;
        $this->role->save();
        $this->role->permissions()->sync($request->permissions);

        return $this->role;
    }
}
