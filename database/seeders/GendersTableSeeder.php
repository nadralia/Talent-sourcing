<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GendersTableSeeder extends Seeder
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

        $genders = [
            [
                'id'         => 1,
                'name'       => 'Female',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 2,
                'name'       => 'Male',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 3,
                'name'       => 'Other',
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($genders as $gender) {
            DB::table('genders')->updateOrInsert( [ 'id' => $gender['id'] ], $gender);
        }
    }
}
