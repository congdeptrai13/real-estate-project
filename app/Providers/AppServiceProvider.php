<?php

namespace App\Providers;

use App\Models\SmtpSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config as FacadesConfig;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        if (Schema::hasTable('smtp_settings')) {
            $smtp = SmtpSetting::find(1);
            if ($smtp) {
                $data = [
                    'driver' => $smtp->mail,
                    'host' => $smtp->host,
                    'port' => $smtp->post,
                    'username' => $smtp->username,
                    'password' => $smtp->password,
                    'encryption' => $smtp->encryption,
                    'from' => [
                        "address" => $smtp->from_address,
                        "name" => 'Easy Learning'
                    ],
                ];
                FacadesConfig::set('mail', $data);
            }
        }
    }
}
