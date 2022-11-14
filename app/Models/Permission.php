<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public const CREATE = 1;
    public const READ = 2;
    public const UPDATE = 3;
    public const DELETE = 4;

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
