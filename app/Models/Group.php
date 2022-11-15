<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function scopeGetGroups()
    {
        return Group::all();
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // public function sessions()
    // {
    //     return $this->belongsToMany(Session::class);
    // }
}
