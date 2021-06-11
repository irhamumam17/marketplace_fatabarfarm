<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PusherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if(Schema::hasTable('configurations')){
            $pusher_config = DB::table('configurations')->where('name','=','pusher')->first();
            if(!empty($pusher_config)){
                $data = json_decode($pusher_config->detail,true);
                $config = array(
                    'driver'     => 'pusher',
                    'key'       => $data['app_key'],
                    'secret'       => $data['app_secret'],
                    'app_id' => $data['app_id'],
                    'options'       => array('cluster' => $data['app_cluster'], 'useTLS' => $data['useTLS']==='true'?true:false),
                );
                Config::set('broadcasting.connections.pusher', $config);
            }
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
