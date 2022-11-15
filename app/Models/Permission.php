<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public const USERS_VIEW_ANY = 1;
    public const USERS_VIEW = 2;
    public const USERS_CREATE = 3;
    public const USERS_UPDATE = 4;
    public const USERS_DELETE = 5;
    public const ROLES_VIEW_ANY = 6;
    public const ROLES_VIEW = 7;
    public const ROLES_CREATE = 8;
    public const ROLES_UPDATE = 9;
    public const ROLES_DELETE = 10;
    public const GROUPS_VIEW_ANY = 11;
    public const GROUPS_VIEW = 12;
    public const GROUPS_CREATE = 13;
    public const GROUPS_UPDATE = 14;
    public const GROUPS_DELETE = 15;

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
