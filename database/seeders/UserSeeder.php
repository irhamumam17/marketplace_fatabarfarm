<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = File::create([
            'path' => 'assets/images/user/default.png',
        ]);

        $user = new User();
        $user->name = "admin";
        $user->email = "admin@gmail.com";
        $user->password = 'admin123';
        $user->role = "admin";
        $user->address = "Rembang";
        $user->image = $file->uuid;
        $user->email_verified_at = Carbon::now();
        $user->save();
    }
}
