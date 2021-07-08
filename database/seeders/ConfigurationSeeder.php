<?php

namespace Database\Seeders;

use App\Models\Configuration;
use App\Models\File;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = File::create([
            'path' => 'uploads/images/configurations/logo.png'
        ]);
        Configuration::insert([
            [
                'name' => 'ui',
                'content' => '{"app_name":"Marketplace","logo":"'.$file->uuid.'"}'
            ],
            [
                'name' => 'pusher',
                'content' => '{"driver":"pusher","app_id":"1183097","app_key":"fa6d9ba38abf0fbab613","app_secret":"e358850c47e30c0f63bc","app_cluster":"ap1","useTLS":"true"}'
            ],
            [
                'name' => 'smtp',
                'content' => '{"email":"admin@fatabarfarm.com","sender_name":"Fatabar Farm Support","host":"mail.fatabarfarm.com","port":"587","username":"admin@fatabar.com","password":"lancar_jaya","encryption":"tls"}'
            ],
            [
                'name' => 'rajaongkir',
                'content' => '{"api_key":"4bf18df47cfe61ec806b01a7ec45da7d","package":"starter"}'
            ]
        ]);
    }
}
