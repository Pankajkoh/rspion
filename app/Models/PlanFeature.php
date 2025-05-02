<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PricingPlanFeature;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanFeature extends Model
{
    protected $table = 'plan_features';
    protected $with = ['pricingPlanFeature'];
    use HasFactory;

    public function pricingPlanFeature(): BelongsTo
    {
        return $this->belongsTo(PricingPlanFeature::class, 'subscription_features_id', 'id');
    }
}
