<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    const features = [
        [
            'feature_slug' => 'invoices_management',
            'feature_name' => 'Invoices Management',
            'feature_type' => 'boolean',
            'feature_default' => false,
        ],
        [
            'feature_slug' => 'finances_management',
            'feature_name' => 'Finances Management',
            'feature_type' => 'boolean',
            'feature_default' => false,
        ],
        [
            'feature_slug' => 'total_users',
            'feature_name' => 'Total users',
            'feature_type' => 'number',
            'feature_default' => 1,
        ]
    ];

    public function subscriptions() {
        return $this->hasMany(Subscription::class);
    }

    protected function features(): Attribute {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value)
        );
    }

    protected function monthlyPrice(): Attribute {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => cleanFormatedMoney($value)
        );
    }

    protected function quarterlyPrice(): Attribute {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => cleanFormatedMoney($value)
        );
    }

    protected function semiannuallyPrice(): Attribute {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => cleanFormatedMoney($value)
        );
    }

    protected function annuallyPrice(): Attribute {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => cleanFormatedMoney($value)
        );
    }
    
}
