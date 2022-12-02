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

        $users = User::all();

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

        $groups = Group::all();
        $permissions = Permission::all();
        $roles = Role::all();
        $titles = UserTitle::all();

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
            'last_name' => $request->lastName,
            'first_name' => $request->firstName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $request->avatar,
            'role_id' => intval($request->role),
            'title_id' => intval($request->title),
        ]);

        if ($request->groups) $user->groups()->attach(array_map('intval', $request->groups));

        $role = Role::where('id', intval($request->role))->first();
        $permissions = array();

        foreach ($role->permissions as $permission) array_push($permissions, $permission->id);

        $user->permissions()->attach(array_map('intval', $permissions));

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

        $groups = Group::all();
        $roles = Role::all();
        $titles = UserTitle::all();

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
            'last_name' => $request->lastName,
            'first_name' => $request->firstName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $request->avatar,
            'role_id' => intval($request->role),
            'title_id' => intval($request->title),
        ]);

        if ($request->groups) $user->groups()->sync(array_map('intval', $request->groups));
        else $user->groups()->sync([]);

        $role = Role::where('id', intval($request->role))->first();
        $permissions = array();

        foreach ($role->permissions as $permission) array_push($permissions, $permission->id);

        $user->permissions()->sync(array_map('intval', $permissions));

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
