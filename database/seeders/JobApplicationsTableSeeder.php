<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker      = Faker::create();
        $startDate  = now()->subMonths(3);
        $endDate    = now();

        // Generate 20 job application records
        for ($i = 0; $i < 50; $i++) {
            DB::table('job_applications')->insert([
                'user_id' => $faker->numberBetween(1, 10), // Assuming you have 10 users
                'employer_id' => $faker->numberBetween(1, 5), // Assuming you have 5 employers
                'job_id' => $faker->numberBetween(1, 10), // Assuming you have 10 jobs
                'status' => $faker->randomElement(['Applied', 'Hired']),
                'created_at' => $faker->dateTimeBetween($startDate, $endDate),
                'updated_at' => $faker->dateTimeBetween($startDate, $endDate),
            ]);
        }
    }
}
