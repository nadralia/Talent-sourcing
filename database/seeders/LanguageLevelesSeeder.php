<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageLevelesSeeder extends Seeder
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
                'name'       => 'Basic',
                'score'      => 1,
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 2,
                'name'       => 'Conversational',
                'score'      => 2,
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 3,
                'name'       => 'Fluent',
                'score'      => 3,
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 4,
                'name'       => 'Native',
                'score'      => 4,
                'enabled'    => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($list as $item) {
            DB::table('language_levels')->updateOrInsert( [ 'id' => $item['id'] ], $item);
        }
    }
}
