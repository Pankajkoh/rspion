<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{

    protected $table = 'modules';
    use HasFactory;

    public function permissions(): HasMany
    {
        return $this->hasMany(AdminPermission::class, 'module_id', 'id');
    }
}
