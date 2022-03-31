<?php

namespace Database\Seeders;

use App\Models\Platform_Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Platform_ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Platform_Apartment::factory()
            ->count(50)
            ->create();
    }
}
