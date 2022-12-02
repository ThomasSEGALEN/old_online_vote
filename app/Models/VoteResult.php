<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteResult extends Model
{
    use HasFactory;

    protected $fillable = ['influence', 'answer_id', 'user_id', 'vote_id'];
    
    public function answer()
    {
        return $this->belongsTo(VoteAnswer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vote()
    {
        return $this->belongsTo(Vote::class);
    }
}
