<?php

namespace App\Business\Scopes;

use App\Models\GlobalConfig;
use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;

class BusinessScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (auth()->check()) {

            $user = auth()->user();
            if (auth()->user()->business_id) {
                $builder->where('business_id', $user->business_id);
            }
        }
    }
}