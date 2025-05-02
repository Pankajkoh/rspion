<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];


    const INACTIVE = 0;
    const ACTIVE = 1;
    // const ROLE_GROUPS = ['Staff Management', 'Customer Management', 'Template Management', 'Other'];

    // Relationship with permissions
    public function permissions()
    {
        return $this->belongsToMany(AdminPermission::class);
    }
    public function rolePermissions()
    {
        return $this->hasMany(RolePermission::class, 'role_id', 'id');
    }

    // Relationship with users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
