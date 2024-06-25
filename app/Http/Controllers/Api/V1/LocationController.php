<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function states(Country $country) {
        return response()->json($country->states);
    }

    public function cities(State $state) {
        return response()->json($state->cities);
    }

}
