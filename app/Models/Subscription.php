<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function business() {
        return $this->belongsTo(Business::class);
    }

    public function plan() {
        return $this->belongsTo(Plan::class);
    }

    public function startDate(): Attribute {
        return Attribute::make(
            get: fn ($value) => date('Y-m-d', strtotime($value)),
            set: fn ($value) => $value
        );
    }

    public function endDate(): Attribute {
        return Attribute::make(
            get: fn ($value) => date('Y-m-d', strtotime($value)),
            set: fn ($value) => $value
        );
    }
}
