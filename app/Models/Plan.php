<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PlanFeature;

class Plan extends Model
{
    protected $table = 'plans';
    use HasFactory;

    const INACTIVE = 0;
    const ACTIVE = 1;

    public function planFeature()
    {
        return $this->hasOne(PlanFeature::class);
    }
}
