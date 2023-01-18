<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function checkMail($mail)
    {
        return User::where('email', $mail)->first();
    }

    public function index($data)
    {  
        $usersByEmail = User::where('email', 'like', '%' . $data->search . '%')->get();
        $usersByLastname = User::where('last_name', 'like', '%' . $data->search . '%')->get();
        $usersByFirstname = User::where('first_name', 'like', '%' . $data->search . '%')->get();
        $users = $usersByEmail->merge($usersByLastname->merge($usersByFirstname));
        $pagination = false;

        if (!$data->search || !$users->first()) {
            $users = User::paginate(25);
            $pagination = true;
        }

        return ['users' => $users, 'pagination' => $pagination]; 
    }

    public function store($data)
    {
        $user = User::create([
            'last_name' => $data->lastName,
            'first_name' => $data->firstName,
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'avatar' => $data->avatar,
            'role_id' => intval($data->role),
            'title_id' => intval($data->title),
        ]);

        if ($data->groups) $user->groups()->attach(array_map('intval', $data->groups));

        $role = Role::where('id', intval($data->role))->first();
        $permissions = array();

        foreach ($role->permissions as $permission) array_push($permissions, $permission->id);

        $user->permissions()->attach(array_map('intval', $permissions));
    }

    public function update($user, $data)
    {
        if ($data->groups) $user->groups()->sync(array_map('intval', $data->groups));
        else $user->groups()->sync([]);

        // Check si le rôle a changé
        $role = Role::where('id', intval($data->role))->first();
        $userPermissions = $user->permissions->pluck('id')->toArray();

        if (intval($data->role) !== $user->role->id) {
            $permissions = array();
    
            foreach ($role->permissions as $permission) array_push($permissions, $permission->id);
    
            $user->permissions()->sync(array_map('intval', $permissions));
        }

        // Check si les permissions ont changé
        $permissions = array_map('intval', $data->permissions);

        if ($permissions !== $userPermissions) {
            sort($permissions);
            $user->permissions()->sync($permissions);
        }

        $user->update([
            'last_name' => $data->lastName,
            'first_name' => $data->firstName,
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'avatar' => $data->avatar,
            'role_id' => intval($data->role),
            'title_id' => intval($data->title),
        ]);
    }

    public function destroy($user)
    {
        $user->groups()->detach($user->groups()->pluck('id')->toArray());
        $user->permissions()->detach($user->permissions()->pluck('id')->toArray());
        $user->sessions()->detach($user->sessions()->pluck('id')->toArray());
        $user->delete();
    }
}