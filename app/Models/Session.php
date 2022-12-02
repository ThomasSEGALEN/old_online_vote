<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
