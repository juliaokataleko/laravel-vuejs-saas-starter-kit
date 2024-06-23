<?php

namespace App\Business\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

class BusinessObserver
{
    public function creating(Model $model)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $model->setAttribute('business_id', $user->business_id);
            $model->setAttribute('employee_id', $user->id);
            $model->setAttribute('uuid', Uuid::uuid4());
        }
    }
}
