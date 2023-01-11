<?php

namespace App\Services;

use App\Models\Vote;
use App\Models\VoteAnswer;
use App\Models\VoteResult;

class VoteService
{
    public function checkTitle($title, $sessionId)
    {
        return Vote::where('title', $title)->where('session_id', $sessionId)->first();
    }

    public function store($data, $sessionId)
    {
        $vote = Vote::create([
            'title' => $data->title,
            'description' => $data->description,
            'session_id' => $sessionId,
            'type_id' => intval($data->type),
        ]);

        foreach ($data->answers as $key => $answer) {
            if ($answer) VoteAnswer::create(['name' => $answer, 'color' => $data->colors[$key], 'vote_id' => $vote->id]);
        }
    }

    public function update($vote, $data)
    {
        $vote->update([
            'title' => $data->title,
            'description' => $data->description,
            'type_id' => intval($data->type),
        ]);
    }

    public function destroy($vote)
    {
        $vote->delete();
    }

    public function vote($answerId, $userId, $voteId)
    {
        VoteResult::create([
            'answer_id' => $answerId,
            'user_id' => $userId,
            'vote_id' => $voteId,
        ]);
    }
}