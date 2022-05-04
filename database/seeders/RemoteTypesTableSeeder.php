<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RemoteTypesTableSeeder extends Seeder
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

        $remote_types = [
            [
                'id'         => 1,
                'name'       => 'Full Remote',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 2,
                'name'       => 'Hybrid',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 3,
                'name'       => 'In Office',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($remote_types as $type) {
            DB::table('remote_types')->updateOrInsert( [ 'id' => $type['id'] ], $type);
        }
    }
}
