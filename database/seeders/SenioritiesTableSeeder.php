<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SenioritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $seniorities = [
            [
                'id'         => 1,
                'name'       => 'Junior',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 2,
                'name'       => 'Intermediate',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 3,
                'name'       => 'Senior',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 4,
                'name'       => 'Manager',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 5,
                'name'       => 'Director',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 6,
                'name'       => 'Executive',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($seniorities as $senioriy) {
            DB::table('seniorities')->updateOrInsert( [ 'id' => $senioriy['id'] ], $senioriy);
        }
    }
}
