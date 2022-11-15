<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public const VIEW_ANY = 1;
    public const VIEW = 2;
    public const CREATE = 3;
    public const UPDATE = 4;
    public const DELETE = 5;

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
