<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Plan;

class PricingPlanFeature extends Model
{
    protected $table = 'pricing_plan_features';
    use HasFactory;


    
    public function plans(): HasMany
    {
        return $this->hasMany(Plan::class);
    }
}
