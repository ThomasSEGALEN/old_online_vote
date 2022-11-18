<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);

        $roles = Role::getRoles();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Role::class);

        $permissions = Permission::getPermissions();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $this->authorize('create', Role::class);

        $nameAlreadyUsed = Role::where('name', $request->name)->first();
            
        if ($nameAlreadyUsed) return back()->with('roleCreateFailure', 'Ce nom est déjà utilisé');

        $role = Role::create([
            'name' => $request->name,
        ]);

        $role->permissions()->attach(array_map('intval', $request->permission_id));

        return back()->with('roleCreateSuccess', 'Le rôle a été créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        if (!$role) return back()->with('roleViewFailure', "Ce rôle n'existe pas");

        $this->authorize('view', $role);

        $permissions = Permission::getPermissions();

        return view('roles.show', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        if (!$role) return back()->with('roleUpdateFailure', "Ce rôle n'existe pas");

        $this->authorize('update', $role);

        $permissions = Permission::getPermissions();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if (!$role) return back()->with('roleUpdateFailure', "Ce rôle n'existe pas");

        $this->authorize('update', $role);

        if ($request->name !== $role->name) {
            $nameAlreadyUsed = Role::where('name', $request->name)->first();
            
            if ($nameAlreadyUsed) return back()->with('roleUpdateFailure', 'Ce nom est déjà utilisé');
        }

        $role->update([
            'name' => $request->name,
        ]);

        $role->permissions()->sync(array_map('intval', $request->permission_id));

        return back()->with('roleUpdateSuccess', 'Le rôle a été modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if (!$role) return redirect()->route('roles.index')->with('roleDeleteFailure', "Ce rôle n'existe pas");

        $this->authorize('delete', $role);

        $role->permissions()->detach($role->permissions()->pluck('id')->toArray());
        $role->delete();

        return redirect()->route('roles.index')->with('roleDeleteSuccess', 'Le rôle a été supprimé avec succès');
    }
}
