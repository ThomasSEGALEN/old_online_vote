<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'result', 'vote_id'];

    public function scopeGetVoteAnswers()
    {
        return VoteAnswer::all();
    }

    public function votes()
    {
        return $this->belongsTo(Vote::class);
    }
}
