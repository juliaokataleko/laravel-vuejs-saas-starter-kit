<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Stats\Traits\HasStats;

class Payment extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function subscription() {
        return $this->belongsTo(Subscription::class)->with(['business', 'plan']);
    }

    protected function amount(): Attribute {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => cleanFormatedMoney($value)
        );
    }
}
