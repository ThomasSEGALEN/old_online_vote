<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTitle extends Model
{
    use HasFactory;

    protected $fillable = ['short_name', 'long_name'];

    public const MAN = 1;
    public const WOMAN = 2;

    public function scopeGetUserTitles()
    {
        return UserTitle::all();
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
