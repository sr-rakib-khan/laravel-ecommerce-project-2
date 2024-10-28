<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $mailConfig = DB::table('mails')->first();

        if ($mailConfig) {
            Config::set('mail.mailers.smtp.host', $mailConfig->host);
            Config::set('mail.mailers.smtp.port', $mailConfig->port);
            Config::set('mail.mailers.smtp.username', $mailConfig->user_name);
            Config::set('mail.mailers.smtp.password', $mailConfig->password);
            Config::set('mail.from.address', $mailConfig->mailer);
            Config::set('mail.from.name', $mailConfig->mailer_name);
        }
    }
}
