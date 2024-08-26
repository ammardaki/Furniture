<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // في ملف Kernel.php

$schedule->command('App\Console\Commands\SendNewsletter@handle')->weekly();
       $schedule->command('sendNewsletter:run')->weekly();
        $schedule->command('send:newsletter')->weekly();
        return Command::SUCCESS;
    }
}
