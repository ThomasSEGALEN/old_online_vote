<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    public function checkName($name)
    {
        Role::where('name', $name)->first();
    }

    public function store($data)
    {
        $role = Role::create([
            'name' => $data->name,
        ]);

        $role->permissions()->attach(array_map('intval', $data->permissions));
    }

    public function update($role, $data)
    {
        $role->update([
            'name' => $data->name,
        ]);

        $role->permissions()->sync(array_map('intval', $data->permissions));
    }

    public function destroy($role)
    {
        $role->permissions()->detach($role->permissions()->pluck('id')->toArray());
        $role->delete();
    }
}