<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);

        $roles = Role::all();

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

        $permissions = Permission::all();

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
            
        if ($this->roleService->checkName($request->name)) return back()->with('roleCreateFailure', 'Ce nom est déjà utilisé');

        $this->roleService->store($request);

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

        return view('roles.show', compact('role'));
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

        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        if (!$role) return back()->with('roleUpdateFailure', "Ce rôle n'existe pas");

        $this->authorize('update', $role);

        if ($request->name !== $role->name) {            
            if ($this->roleService->checkName($request->name)) return back()->with('roleUpdateFailure', 'Ce nom est déjà utilisé');
        }

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

        if ($role->users()->first()) return redirect()->route('roles.index')->with('roleDeleteFailure', "Ce rôle ne peut pas être supprimé");

        return redirect()->route('roles.index')->with('roleDeleteSuccess', 'Le rôle a été supprimé avec succès');
    }
}
