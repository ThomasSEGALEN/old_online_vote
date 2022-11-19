<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Group::class);

        $groups = Group::getGroups();

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

        $users = User::getUsers();

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

        $nameAlreadyUsed = Group::where('name', $request->name)->first();
            
        if ($nameAlreadyUsed) return back()->with('groupCreateFailure', 'Ce nom est déjà utilisé');

        $group = Group::create([
            'name' => $request->name,
        ]);

        $group->users()->attach(array_map('intval', $request->user_id));

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

        $users = User::getUsers();

        return view('groups.show', compact('group', 'users'));
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

        $users = User::getUsers();

        return view('groups.edit', compact('group', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        if (!$group) return back()->with('groupUpdateFailure', "Ce groupe n'existe pas");

        $this->authorize('update', $group);

        if ($request->name !== $group->name) {
            $nameAlreadyUsed = Group::where('name', $request->name)->first();
            
            if ($nameAlreadyUsed) return back()->with('groupUpdateFailure', 'Ce nom est déjà utilisé');
        }

        $group->update([
            'name' => $request->name,
        ]);

        $group->users()->sync(array_map('intval', $request->user_id));

        $sessions = $group->sessions()->get();

        foreach ($sessions as $session) $session->users()->sync(array_map('intval', $request->user_id));

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

        $sessions = $group->sessions()->get();

        foreach ($sessions as $session) {
            $session->users()->detach($session->users()->pluck('id')->toArray());
        }

        $group->sessions()->detach($group->sessions()->pluck('id')->toArray());
        $group->users()->detach($group->users()->pluck('id')->toArray());
        $group->delete();

        return redirect()->route('groups.index')->with('groupDeleteSuccess', 'Le groupe a été supprimé avec succès');
    }
}
