<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobStatusSeeder extends Seeder
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

        $list = [
            [
                'id'         => 1,
                'name'       => 'Actively Open to Job Offers',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 2,
                'name'       => 'Passively Open to Job Offers',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 3,
                'name'       => 'Not Open to Job Offers',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($list as $item) {
            DB::table('job_statuses')->updateOrInsert( [ 'id' => $item['id'] ], $item);
        }
    }
}
