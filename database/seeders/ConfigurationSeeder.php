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
                'content' => '{"email":"no-reply@fatabarfarm.id","sender_name":"Fatabar Farm","host":"in-v3.mailjet.com","port":"587 ","username":"3152800ecc1c525d01615d59854fe098","password":"87c6697299e7a5c689392fe08718b748
","encryption":"ssl"}'
            ],
            // [
            //     'name' => 'smtp',
            //     'content' => '{"email":"no-reply@fatabarfarm.id","sender_name":"Fatabar Farm","host":"smtp-relay.sendinblue.com","port":"587","username":"coklatbrown356@gmail.com","password":"xkMUBWcLrvIp4J2G","encryption":"tls"}'
            // ],
        ]);
    }
}
