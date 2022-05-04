<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VettingStagesTableSeeder extends Seeder
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
                'id'          => 1,
                'name'        => 'Account Created',
                'description' => 'Moved to Step 1 (Account Created)',
                'enabled'     => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 2,
                'name'        => 'Code Test Done',
                'description' => 'Moved to Step 2 (Code Test Done)',
                'enabled'     => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 3,
                'name'        => 'Take-Home Test Done',
                'description' => 'Moved to Step 3 (Take-Home Test Done)',
                'enabled'     => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 4,
                'name'        => 'HR Conversation Done',
                'description' => 'Moved to Step 4 (HR Conversation Done)',
                'enabled'     => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        foreach ($list as $item) {
            DB::table('vetting_stages')->updateOrInsert( [ 'id' => $item['id'] ], $item);
        }
    }
}
