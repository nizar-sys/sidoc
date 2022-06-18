<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
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
                'name' => 'maker',
                'created_at' => now(),
            ],
            [
                'name' => 'approver',
                'created_at' => now(),
            ]
        ];

        Role::insert($roles);
    }
}
