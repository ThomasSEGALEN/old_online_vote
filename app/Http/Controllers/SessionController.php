<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Models\Group;
use App\Models\Session;
use App\Models\Vote;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Session::class);

        $sessions = Session::getSessions();

        return view('sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Session::class);

        $groups = Group::getGroups();

        return view('sessions.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSessionRequest $request)
    {
        $this->authorize('create', Session::class);

        $titleAlreadyUsed = Session::where('title', $request->title)->first();

        if ($titleAlreadyUsed) return back()->with('sessionCreateFailure', 'Ce titre est déjà utilisé');

        $session = Session::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $session->groups()->attach(array_map('intval', $request->group_id));

        $groups = Group::whereIn('id', array_map('intval', $request->group_id))->get();
        $user_id = array();

        foreach ($groups as $group) {
            if (!$user_id) $user_id = $group->users->pluck('id')->toArray();
            else $user_id = array_merge($user_id, $group->users->pluck('id')->toArray());
        }

        $session->users()->sync($user_id);

        return back()->with('sessionCreateSuccess', 'La séance a été créée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        if (!$session) return back()->with('sessionViewFailure', "Cette séance n'existe pas");

        $this->authorize('view', $session);

        return view('sessions.show', compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        if (!$session) return back()->with('sessionUpdateFailure', "Cette séance n'existe pas");

        $this->authorize('update', $session);

        $groups = Group::getGroups();

        return view('sessions.edit', compact('session', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSessionRequest $request, Session $session)
    {
        if (!$session) return back()->with('sessionUpdateFailure', "Cette séance n'existe pas");

        $this->authorize('update', $session);

        if ($request->title !== $session->title) {
            $titleAlreadyUsed = Session::where('title', $request->title)->first();
            
            if ($titleAlreadyUsed) return back()->with('sessionUpdateFailure', 'Ce titre est déjà utilisé');
        }

        $session->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $session->groups()->sync(array_map('intval', $request->group_id));

        $groups = Group::whereIn('id', array_map('intval', $request->group_id))->get();
        $user_id = array();

        foreach ($groups as $group) {
            if (!$user_id) $user_id = $group->users->pluck('id')->toArray();
            else $user_id = array_merge($user_id, $group->users->pluck('id')->toArray());
        }

        $session->users()->sync($user_id);

        return back()->with('sessionUpdateSuccess', 'La séance a été modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        if (!$session) return redirect()->route('sessions.index')->with('sessionDeleteFailure', "Cette session n'existe pas");

        $this->authorize('delete', $session);

        $session->groups()->detach($session->groups()->pluck('id')->toArray());
        $session->users()->detach($session->users()->pluck('id')->toArray());
        $session->delete();

        return redirect()->route('sessions.index')->with('sessionDeleteSuccess', 'La séance a été supprimée avec succès');
    }
}
