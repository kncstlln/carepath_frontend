<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendSMSTask extends Command
{
    protected $signature = 'send:sms';
    protected $description = 'Send SMS messages for upcoming vaccinations';

    public function handle()
    {
        // Call your sendSMS function here
        app()->call('App\Http\Controllers\Admin\AdminUpcomingVaccination@sendSMS');
        $this->info('SMS messages sent successfully!');
    }
}
