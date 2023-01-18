<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Group;
use App\Models\Permission;
use App\Models\Role;
use App\Models\UserTitle;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $data = $this->userService->index($request);
        $users = $data['users'];
        $pagination = $data['pagination'];

        return view('users.index', compact('users', 'pagination'));
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

        $mailAlreadyUsed = $this->userService->checkMail($request->email);
        
        if ($mailAlreadyUsed) return back()->withInput()->with('userCreateFailure', 'Cette adresse mail est déjà utilisée');

        $this->userService->store($request);

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
        //
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
            if ($this->userService->checkMail($request->email)) return back()->with('userUpdateFailure', 'Cette adresse mail est déjà utilisée');
        }

        $this->userService->update($user, $request);

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

        $username = $user->last_name . ' ' . $user->first_name;

        $this->userService->destroy($user);

        return redirect()->route('users.index')->with('userDeleteSuccess', "L'utilisateur " . $username . " a été supprimé avec succès");
    }

    public function profile()
    {
        $user = auth()->user();

        return view('users.profile', compact('user'));
    }
}
