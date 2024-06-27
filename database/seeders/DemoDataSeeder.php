<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $planName = 'Basic Plan Pro' . rand(10000, 90000);
        $planDemo = Plan::query()->create([
            'name' =>  $planName,
            'slug' => Str::slug( $planName),
            'monthly_price' => 10.90,
            'quarterly_price' => 30.90,
            'semiannually_price' => 50.90,
            'annually_price' => 90.90,
        ]);

        Business::factory(100)->create();
        Subscription::factory(100)->create();
        User::factory(100)->create([
            'business_id' => Business::inRandomOrder()->first()->id
        ]);
    }
}
