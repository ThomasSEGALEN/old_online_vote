<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use App\Models\User;
use App\Services\GroupService;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    private GroupService $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Group::class);

        $groups = Group::all();

        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Group::class);

        $users = User::all();

        return view('groups.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request)
    {
        $this->authorize('create', Group::class);
            
        if ($this->groupService->checkName($request->name)) return back()->withInput()->with('groupCreateFailure', 'Ce nom est déjà utilisé');

        $this->groupService->store($request);

        return back()->with('groupCreateSuccess', 'Le groupe a été créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        if (!$group) return back()->with('groupViewFailure', "Ce groupe n'existe pas");

        $this->authorize('view', $group);

        return view('groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        if (!$group) return back()->with('groupUpdateFailure', "Ce groupe n'existe pas");

        $this->authorize('update', $group);

        $users = User::all();

        return view('groups.edit', compact('group', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        if (!$group) return back()->with('groupUpdateFailure', "Ce groupe n'existe pas");

        $this->authorize('update', $group);

        $this->groupService->update($group, $request);

        return back()->with('groupUpdateSuccess', 'Le groupe a été modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        if (!$group) return redirect()->route('groups.index')->with('groupDeleteFailure', "Ce groupe n'existe pas");

        $this->authorize('delete', $group);

        $this->groupService->destroy($group);

        return redirect()->route('groups.index')->with('groupDeleteSuccess', 'Le groupe a été supprimé avec succès');
    }
}
