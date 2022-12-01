<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'vote_id'];

    public function scopeGetVoteAnswers()
    {
        return VoteAnswer::all();
    }

    public function results()
    {
        return $this->hasMany(VoteResult::class);
    }

    public function votes()
    {
        return $this->belongsTo(Vote::class);
    }
}
