<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ConfigurationSeeder::class,
            LocationsSeeder::class,
            InformationSeeder::class,
            PostSeeder::class,
            ProductSeeder::class,
            BankSeeder::class
        ]);
    }
}
