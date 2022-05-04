<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoticePeriodsTableSeeder extends Seeder
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
                'name'       => 'Immediately',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 2,
                'name'       => '1 week',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'        => 3,
                'name'       => '2 weeks',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 4,
                'name'       => '1 month',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 5,
                'name'       => '2 months',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 6,
                'name'       => '3 months',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 7,
                'name'       => '3+ months',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($list as $data) {
            DB::table('notice_periods')->updateOrInsert( [ 'id' => $data['id'] ], $data);
        }
    }
}
