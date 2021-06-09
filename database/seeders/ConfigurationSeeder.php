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
                'content' => '{"app_id":"1183097","app_key":"fa6d9ba38abf0fbab613","app_secret":"e358850c47e30c0f63bc","app_cluster":"ap1"}'
            ],
            [
                'name' => 'smtp',
                'content' => '{"email":"no-reply@marketplace.id","sender_name":"Marketplace","host":"smtp.mailtrap.io","port":"2525","username":"b21765a5b2c2f8","password":"f9c1a85fd5185c","encryption":"tls"}'
            ],
            [
                'nama'=>'fcm',
                'detail'=> '{"server_key":"AAAA2rLN52o:APA91bHDs9ENkXekhxOrMqP7JavOeM03WP2YcNxtc6kWj5-0VnA4hL_eMtkXCo8NrI2ZaRN4Pynmk-oHMe0vl-thhF1b_5izGmPrjeKajrMt7wNYUzztRcyKbBfNihY5abSCDsGnvxQ-"}',
            ],
        ]);
    }
}
