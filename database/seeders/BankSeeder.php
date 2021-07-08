<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::create([
            'name' => 'BRI',
            'account_number' => '08982782382638'
        ]);

        Bank::create([
            'name' => 'BNI',
            'account_number' => '08982782382631'
        ]);
    }
}
