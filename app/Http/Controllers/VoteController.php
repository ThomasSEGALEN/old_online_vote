<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
use App\Models\Session;
use App\Models\Vote;
use App\Models\VoteAnswer;
use App\Models\VoteResult;
use App\Models\VoteType;
use App\Services\VoteService;
use Illuminate\Http\Request;
use PDF;

class VoteController extends Controller
{
    private VoteService $voteService;

    public function __construct(VoteService $voteService)
    {
        $this->voteService = $voteService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Vote::class);

        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $sessionId)
    {
        $this->authorize('create', Vote::class);

        $types = VoteType::all();
        $session = Session::where('id', $sessionId)->first();

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

        if ($this->voteService->checkTitle($request->title, $session->id)) return back()->withInput()->with('voteCreateFailure', 'Ce titre est déjà utilisé');

        $this->voteService->store($request, $session->id);

        return back()->with('voteCreateSuccess', 'Le vote a été créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $vote)
    {
        if (!$vote) return back()->with('voteViewFailure', "Ce vote n'existe pas");

        $this->authorize('view', $vote);

        $answers = VoteAnswer::where('vote_id', $vote->id)->get();

        return view('votes.show', compact('vote', 'answers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function edit(Vote $vote)
    {
        if (!$vote) return back()->with('voteUpdateFailure', "Ce vote n'existe pas");

        $this->authorize('update', $vote);

        $types = VoteType::all();

        return view('votes.edit', compact('vote', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoteRequest $request, Vote $vote)
    {
        if (!$vote) return back()->with('voteUpdateFailure', "Ce vote n'existe pas");

        $this->authorize('update', $vote);

        if ($request->title !== $vote->title) {
            if ($this->voteService->checkTitle($request->title, $vote->session_id)) return back()->with('voteCreateFailure', 'Ce titre est déjà utilisé');
        }

        $this->voteService->update($vote, $request);

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

        $this->voteService->destroy($vote);

        return redirect()->route('sessions.show', $session)->with('voteDeleteSuccess', 'Le vote a été supprimé avec succès');
    }

    public function selectAnswer(Vote $vote, VoteAnswer $answer)
    {
        $this->voteService->vote($answer->id, auth()->user()->id, $vote->id);

        return back()->with('answerCreateSuccess', 'Vous avez voté');
    }

    public function changeStatus(Vote $vote)
    {
        if ($vote->status) $vote->update(['status' => Vote::CLOSE]);
        else $vote->update(['status' => Vote::OPEN]);

        return redirect()->route('sessions.show', $vote->session);
    }

    public function exportResults(Vote $vote)
    {
        // dd($vote->results->where('vote_id', $vote->id));

        $results = VoteResult::where('vote_id', $vote->id)->get();
        $answers = VoteAnswer::where('vote_id', $vote->id)->get();

        // $a = VoteResult::join('vote_answers', 'vote_answers.id', 'vote_results.answer_id')->where('vote_results.vote_id', $vote->id)->get();
        // dd($a);

        $data = [
            'vote' => $vote,
            'answers' => $answers,
            'results' => $results,
        ];
        $pdf = PDF::loadView('pdf.votes', $data);
        return $pdf->download('votes.pdf');
    }
}
