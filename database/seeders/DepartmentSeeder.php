<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['name' => 'Front Office', 'description' => 'Reception & front desk'],
            ['name' => 'Restaurant', 'description' => 'Food & beverages'],
            ['name' => 'Housekeeping', 'description' => 'Room cleaning'],
            ['name' => 'Accounts', 'description' => 'Finance & billing'],
        ];

        foreach ($departments as $dept) {
            Department::updateOrCreate(
                ['name' => $dept['name']],
                $dept
            );
        }
    }
}

