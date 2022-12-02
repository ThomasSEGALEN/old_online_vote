<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'session_id',
        'type_id',
    ];

    public function answers()
    {
        return $this->hasMany(VoteAnswer::class);
    }

    public function results()
    {
        return $this->hasMany(VoteResult::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function type()
    {
        return $this->belongsTo(VoteType::class);
    }
}
