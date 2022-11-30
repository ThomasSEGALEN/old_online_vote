<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
use App\Models\Session;
use App\Models\Vote;
use App\Models\VoteAnswer;
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
        $this->authorize('viewAny', Vote::class);

        return 'Vote index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Session $session)
    {
        $this->authorize('create', Vote::class);

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
        $this->authorize('create', Vote::class);

        $titleAlreadyUsed = Vote::where('title', $request->title)->where('session_id', $session->id)->first();

        if ($titleAlreadyUsed) return back()->with('voteCreateFailure', 'Ce titre est déjà utilisé');

        $vote = Vote::create([
            'title' => $request->title,
            'description' => $request->description,
            'session_id' => $session->id,
            'type_id' => intval($request->type_id),
        ]);

        $answers = array();
        array_push($answers, $request->answer_one, $request->answer_two, $request->answer_three, $request->answer_four);

        foreach ($answers as $answer) {
            if ($answer)
                VoteAnswer::create([
                    'name' => $answer,
                    'vote_id' => $vote->id,
                ]);
        }

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

        return view('votes.show', compact('session', 'vote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session, Vote $vote)
    {
        if (!$vote) return back()->with('voteUpdateFailure', "Ce vote n'existe pas");

        $this->authorize('update', $vote);

        $types = VoteType::getVoteTypes();

        return view('votes.edit', compact('session', 'vote', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoteRequest $request, Session $session, Vote $vote)
    {
        if (!$vote) return back()->with('voteUpdateFailure', "Ce vote n'existe pas");

        $this->authorize('update', $vote);

        if ($request->title !== $vote->title) {
            $titleAlreadyUsed = Vote::where('title', $request->title)->where('session_id', $session->id)->first();

            if ($titleAlreadyUsed) return back()->with('voteCreateFailure', 'Ce titre est déjà utilisé');
        }

        $vote->update([
            'title' => $request->title,
            'description' => $request->description,
            'type_id' => intval($request->type_id),
        ]);

        return back()->with('voteUpdateSuccess', 'Le vote a été modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session, Vote $vote)
    {
        if (!$vote) return redirect()->route('sessions.show', $session)->with('voteDeleteFailure', "Ce vote n'existe pas");

        $this->authorize('delete', $vote);

        $vote->delete();

        return redirect()->route('sessions.show', $session)->with('voteDeleteSuccess', 'Le vote a été supprimé avec succès');
    }
}
