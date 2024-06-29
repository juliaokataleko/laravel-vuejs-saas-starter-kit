<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\SaasFeature;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WebsiteController extends Controller
{
    public function index () {

        $features = SaasFeature::whereIsPublished(1)->orderBy('id')->get();
        $plans = Plan::whereIsPublic(1)->orderBy('id')->limit(6)->get();

        return Inertia::render('Website/Index', compact('features', 'plans'));
    }
}
