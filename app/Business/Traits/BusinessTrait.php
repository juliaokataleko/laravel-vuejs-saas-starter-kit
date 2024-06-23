<?php

namespace App\Business\Traits;

use App\Business\Observers\BusinessObserver;
use App\Business\Scopes\BusinessScope;
use App\Models\Business;
use App\Models\User;

trait BusinessTrait
{
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BusinessScope);
        static::observe(new BusinessObserver);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}