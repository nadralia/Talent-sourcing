<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CultureFitCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $list = [
            [
                'id'          => 1,
                'name'        => 'Values',
                'max_choices' => 10,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 2,
                'name'        => 'Behaviors',
                'max_choices' => 10,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 3,
                'name'        => 'Motivations',
                'max_choices' => 5,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        foreach ($list as $item) {
            DB::table('culture_fit_categories')->updateOrInsert([ 'id' => $item['id'] ], $item);
        }
    }
}
