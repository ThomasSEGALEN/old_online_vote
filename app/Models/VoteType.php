<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public const PUBLIC = 1;
    public const SECRET = 2;

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
