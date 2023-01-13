<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    public function checkName($name)
    {
        return Role::where('name', $name)->first();
    }

    public function index($data)
    {
        $roles = Role::where('name', 'like', '%' . $data->search . '%')->get();
        $pagination = false;

        if (!$data->search || !$roles->first()) {
            $roles = Role::paginate(25);
            $pagination = true;
        }

        return ['roles' => $roles, 'pagination' => $pagination]; 
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

        if ($data->permissions) {
            $role->permissions()->sync(array_map('intval', $data->permissions));
        } else {
            $role->permissions()->sync([]);
        }
    }

    public function destroy($role)
    {
        $role->permissions()->detach($role->permissions()->pluck('id')->toArray());
        $role->delete();
    }
}