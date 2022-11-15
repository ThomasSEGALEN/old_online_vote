<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Group;
use App\Models\Role;
use App\Models\Title;
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
        $roles = Role::all();
        $titles = Title::all();

        return view('users.create', compact('groups', 'roles', 'titles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $check = User::where('email', $request->email)->first();

        if ($check && $check->email) return back()->with('userCreateFailure', 'Impossible de créer cet utilisateur');

        $user = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => null,
            'title_id' => intval($request->title_id),
        ]);

        $user->roles()->attach(array_map('intval', $request->role_id));
        $user->groups()->attach(array_map('intval', $request->group_id));

        return back()->with('userCreateSuccess', 'L\'utilisateur a été créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        $groups = Group::all();
        $roles = Role::all();
        $titles = Title::all();

        return view('users.show', compact('user', 'groups', 'roles', 'titles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $groups = Group::all();
        $roles = Role::all();
        $titles = Title::all();

        return view('users.edit', compact('user', 'groups', 'roles', 'titles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $check = User::where('email', $request->email)->first();

        if ($check) return back()->with('userUpdateFailure', 'Impossible de modifier cet utilisateur');

        $user->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => null,
            'title_id' => intval($request->title_id),
        ]);
        
        $user->roles()->attach(array_map('intval', $request->role_id));
        $user->groups()->attach(array_map('intval', $request->group_id));

        return back()->with('userUpdateSuccess', 'L\'utilisateur a été modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
