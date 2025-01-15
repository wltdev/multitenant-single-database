<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;


class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'trial',
                'slug' => 'trial',
                'price' => 0,
                'duration_in_days' => 7
            ],
            [
                'name' => 'Monthly',
                'slug' => 'monthly',
                'price' => 95,
                'duration_in_days' => 30
            ],
            [
                'name' => 'Yearly',
                'slug' => 'yearly',
                'price' => 520,
                'duration_in_days' => 365
            ]
        ];

        Plan::insert($plans);
    }
}
