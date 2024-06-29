<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index () {
        $subscription_message = "";
        $daysLeft = 0;
        $outOfdate = false;
        $alertTime = false;

        $current_subscription = Subscription::whereBusinessId(auth()->user()->business_id)->where('end_date', '>=', now())
        ->whereStatus('active')
        ->orderBy('id', 'desc')->first();

        if ($current_subscription) {

            $date = Carbon::parse($current_subscription->end_date);
            $now = Carbon::now();
            $daysLeft = (int)$now->diffInDays($date);

            if ($current_subscription->is_trial) {
                $alertTime = true;
                $subscription_message = "You are in trial mode. You have $daysLeft days to test our aplication";
            } else {
                $subscription_message = "Your subscription is ON. You have $daysLeft days to use our aplication. keep Up To Date. 😍😍😍😍";
            }

            if ($daysLeft <= Subscription::DAYS_NUMBER_TO_ALERT) {
                $alertTime = true;
                $subscription_message = "You have $daysLeft days to user our aplication. Please update your subscription";
            }

            if ($daysLeft < 1) {
                $alertTime = false;
                $outOfdate = true;
                $subscription_message = "Your subscription is expired. Please pay now to use the application";
            }   

        } else {
            $alertTime = false;
            $outOfdate = true;
            $subscription_message = "Your subscription is expired. Please pay now to use the application";
        }

        $data = [
            'current_subscription' => $current_subscription,
            'daysLeft' => $daysLeft,
            'outOfdate' => $outOfdate,
            'alertTime' => $alertTime,
            'subscription_message' => $subscription_message
        ];

        return Inertia::render('Business/Dashboard/DashIndex', compact('data'));
    }
}
