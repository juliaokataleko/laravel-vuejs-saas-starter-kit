<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $plan = Plan::inRandomOrder()->first();

        return [
            'business_id' => Business::inRandomOrder()->first()->id,
            'plan_id' => $plan->id,
            'billing_cycle' => 'monthly',
            'amount' => $plan->monthly_price,
            'start_date' => now(),
            'end_date' => now()->addYear()
        ];
    }
}
