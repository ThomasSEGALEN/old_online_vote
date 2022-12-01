<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Group;
use App\Models\Permission;
use App\Models\Role;
use App\Models\UserTitle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::getUsers();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);

        $groups = Group::getGroups();
        $permissions = Permission::getPermissions();
        $roles = Role::getRoles();
        $titles = UserTitle::getUserTitles();

        return view('users.create', compact('groups', 'permissions', 'roles', 'titles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);

        $mailAlreadyUsed = User::where('email', $request->email)->first();
            
        if ($mailAlreadyUsed) return back()->with('userCreateFailure', 'Cette adresse mail est déjà utilisée');

        $user = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => null,
            'role_id' => intval($request->role_id),
            'title_id' => intval($request->title_id),
        ]);

        if ($request->group_id) $user->groups()->attach(array_map('intval', $request->group_id));
        else $user->groups()->attach([]);

        $role = Role::where('id', intval($request->role_id))->first();
        $permissions_id = array();

        foreach ($role->permissions as $permission) {
            array_push($permissions_id, $permission->id);
        }

        $user->permissions()->attach(array_map('intval', $permissions_id));

        return back()->with('userCreateSuccess', "L'utilisateur a été créé avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (!$user) return back()->with('userViewFailure', "Cet utilisateur n'existe pas");

        $this->authorize('view', $user);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (!$user) return back()->with('userUpdateFailure', "Cet utilisateur n'existe pas");

        $this->authorize('update', $user);

        $groups = Group::getGroups();
        $roles = Role::getRoles();
        $titles = UserTitle::getUserTitles();

        return view('users.edit', compact('user', 'groups', 'roles', 'titles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if (!$user) return back()->with('userUpdateFailure', "Cet utilisateur n'existe pas");

        $this->authorize('update', $user);

        if ($request->email !== $user->email) {
            $mailAlreadyUsed = User::where('email', $request->email)->first();
            
            if ($mailAlreadyUsed) return back()->with('userUpdateFailure', 'Cette adresse mail est déjà utilisée');
        }

        $user->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => null,
            'role_id' => intval($request->role_id),
            'title_id' => intval($request->title_id),
        ]);

        if ($request->group_id) $user->groups()->sync(array_map('intval', $request->group_id));
        else $user->groups()->sync([]);

        $role = Role::where('id', intval($request->role_id))->first();
        $permissions_id = array();

        foreach ($role->permissions as $permission) {
            array_push($permissions_id, $permission->id);
        }

        $user->permissions()->sync(array_map('intval', $permissions_id));

        return back()->with('userUpdateSuccess', "L'utilisateur a été modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!$user) return redirect()->route('users.index')->with('userDeleteFailure', "Cet utilisateur n'existe pas");

        $this->authorize('delete', $user);

        $user->groups()->detach($user->groups()->pluck('id')->toArray());
        $user->permissions()->detach($user->permissions()->pluck('id')->toArray());
        $user->sessions()->detach($user->sessions()->pluck('id')->toArray());
        $user->delete();

        return redirect()->route('users.index')->with('userDeleteSuccess', "L'utilisateur a été supprimé avec succès");
    }
}
