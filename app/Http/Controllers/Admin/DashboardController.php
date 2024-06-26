<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\User;
use Flowframe\Trend\Trend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Spatie\Stats\StatsQuery;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $data = [];

        // MRR
        $monthly_mrr = DB::select("
            SELECT  SUM(subscriptions.amount) as total_amount 
            FROM subscriptions 
            WHERE subscriptions.billing_cycle = 'monthly'
        ");

        $quarterly_mrr = DB::select("
            SELECT  SUM(subscriptions.amount) as total_amount 
            FROM subscriptions 
            WHERE subscriptions.billing_cycle = 'quarterly'
        ");

        $semiannually_mrr = DB::select("
            SELECT  SUM(subscriptions.amount) as total_amount 
            FROM subscriptions 
            WHERE subscriptions.billing_cycle = 'semiannually'
        ");

        $yearly_mrr = DB::select("
            SELECT  SUM(subscriptions.amount) as total_amount 
            FROM subscriptions 
            WHERE subscriptions.billing_cycle = 'yearly'
        ");

        $total_monthly_mrr = $monthly_mrr[0]->total_amount + ($quarterly_mrr[0]->total_amount/3) + ($semiannually_mrr[0]->total_amount/6) + ($yearly_mrr[0]->total_amount/12);
        $data['total_monthly_mrr'] = number_format($total_monthly_mrr, 2);

        // Active subscriptions
        $activeSubscriptions = Subscription::whereActive(1)->count();
        $data['active_subscriptions'] = $activeSubscriptions;

        $data['total_users'] = User::where('level', '!=', 'admin')->count();
        $data['total_revenue'] = Payment::whereStatus('succeeded')->sum('amount');
        $data['total_transactions'] = Payment::whereStatus('succeeded')->count();

        // convertion rate
        $data['subscription_version_rate'] = number_format(($data['active_subscriptions']*100) / $data['total_users'], 2); 

        // monthly revenue
        // $monthly_revenue = StatsQuery::for(Payment::class, ['amount'])
        //     ->start(now()->startOfYear())
        //     ->end(now()->endOfYear())
        //     ->groupByMonth()
        //     ->get();

        $monthly_revenue = Trend::model(Payment::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->sum('amount');

        $month_revenue = [
            "labels" => [],
            'data' => []
        ];

        foreach ($monthly_revenue as $key => $value) {
            $month_revenue['labels'][] = $value->date;
            $month_revenue['data'][] = $value->aggregate;
        }

        $data['month_revenue'] = $month_revenue;
        // dd($data);

        return Inertia::render('Admin/Dashboard/DashIndex', compact('data'));
    }
}
