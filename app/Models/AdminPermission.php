<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    protected $table = 'admin_permissions';
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    const INACTIVE = 0;
    const ACTIVE = 1;
    // Relationship with roles.
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
