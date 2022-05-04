<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DegreesTableSeeder extends Seeder
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

        $degrees = [
            [
                'id'         => 1,
                'name'       => 'High School',
                'score'      => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 2,
                'name'       => 'Diploma / Associate Degree',
                'score'      => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 3,
                'name'       => 'Professional Certification ',
                'score'      => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 4,
                'name'       => "Bachelor's degree",
                'score'      => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 5,
                'name'       => 'Post-Graduate Diploma',
                'score'      => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 6,
                'name'       => "Master's degree",
                'score'      => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 7,
                'name'       => 'Doctoral Degree',
                'score'      => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        foreach ($degrees as $degree) {
            DB::table('degrees')->updateOrInsert([ 'id' => $degree['id'] ], $degree);
        }
    }
}
