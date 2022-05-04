<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillLevelsTableSeeder extends Seeder
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

        $levels = [
            [
                'id'          => 1,
                'name'        => 'Beginner',
                'description' => '',
                'enabled'     => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 2,
                'name'        => 'Experienced',
                'description' => '',
                'enabled'     => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 3,
                'name'        => 'Advance',
                'description' => '',
                'enabled'     => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 4,
                'name'        => 'Expert',
                'description' => '',
                'enabled'     => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        foreach ($levels as $level) {
            DB::table('skill_levels')->updateOrInsert( [ 'id' => $level['id'] ], $level);
        }
    }
}
