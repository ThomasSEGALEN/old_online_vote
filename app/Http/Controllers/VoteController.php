<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoteRequest;
use App\Models\Session;
use App\Models\Vote;
use App\Models\VoteType;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Session::class);

        return 'Vote index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Session $session)
    {
        $this->authorize('create', Session::class);

        $types = VoteType::getVoteTypes();

        return view('votes.create', compact('session', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoteRequest $request, Session $session)
    {
        $this->authorize('create', Session::class);

        $titleAlreadyUsed = Vote::where('title', $request->title)->where('session_id', $session->id)->first();

        if ($titleAlreadyUsed) return back()->with('voteCreateFailure', 'Ce titre est déjà utilisé');

        Vote::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => true,
            'session_id' => $session->id,
            'type_id' => intval($request->type_id),
        ]);

        return back()->with('voteCreateSuccess', 'Le vote a été créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session, Vote $vote)
    {
        if (!$vote) return back()->with('voteViewFailure', "Ce vote n'existe pas");

        $this->authorize('view', $vote);

        return view('votes.show', compact('vote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function edit(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        //
    }
}
