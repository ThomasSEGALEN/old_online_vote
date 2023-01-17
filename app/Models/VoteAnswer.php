<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color', 'amount', 'order', 'vote_id'];

    public function results()
    {
        return $this->hasMany(VoteResult::class);
    }

    public function votes()
    {
        return $this->belongsTo(Vote::class);
    }
}
