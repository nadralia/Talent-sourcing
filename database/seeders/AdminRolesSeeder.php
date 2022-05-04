<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class AdminRolesSeeder extends Seeder
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
                'id'   => 1,
                'name' => 'recruiter.super',
            ],
            [
                'id'   => 2,
                'name' => 'recruiter.internal',
            ],
            [
                'id'   => 3,
                'name' => 'recruiter.external',
            ],
            [
                'id'   => 4,
                'name' => 'support.talent',
            ],
            [
                'id'   => 5,
                'name' => 'manager.account',
            ],
            [
                'id'   => 6,
                'name' => 'master',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                [ 'id' => $role['id'] ],
                [ 'name'  => $role['name'], 'guard_name' => 'admin' ]
            );
        }
    }
}
