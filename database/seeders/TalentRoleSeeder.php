<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class TalentRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id'   => 9,
                'name' => 'talent',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                [ 'id' => $role['id'] ],
                [ 'name'  => $role['name'], 'guard_name' => 'talent' ]
            );
        }
    }
}
