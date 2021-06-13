<?php

namespace Database\Seeders;

use App\Models\Configuration;
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
        Configuration::insert([
            [
                'name' => 'ui',
                'content' => '{"web_name":"Marketplace"}'
            ],
            [
                'name' => 'pusher',
                'content' => '{"driver":"pusher","app_id":"1183097","app_key":"fa6d9ba38abf0fbab613","app_secret":"e358850c47e30c0f63bc","app_cluster":"ap1","useTLS":"true"}'
            ],
            [
                'name' => 'smtp',
                'content' => '{"email":"no-reply@fatabarfarm.id","sender_name":"Fatabar Farm","host":"smtp.mailtrap.io","port":"2525","username":"2091896772d8f4","password":"05145bee73face","encryption":"tls"}'
            ],
            [
                'name' => 'rajaongkir',
                'content' => '{"api_key":"4bf18df47cfe61ec806b01a7ec45da7d","package":"starter"}'
            ]
        ]);
    }
}
