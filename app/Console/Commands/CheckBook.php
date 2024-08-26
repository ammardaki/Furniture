<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\reservation;
use Carbon\Carbon;

class CheckBook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:book';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This cron job for check booking in 48h';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        $reservations = reservation::all();
       

        foreach($reservations as $reservation){
            $createdAt = $reservation->created_at;
            $currentDateTime = Carbon::now();

            $twentyFourHoursAgo = $currentDateTime->subHours(24);

       
            if(($createdAt >= $twentyFourHoursAgo) == false){
                 // The reservation was created within the last 24 hours
                //  echo "$createdAt";
                
                reservation::where('id',$reservation->id)->delete();

            } 
          
            
        }




    }
}
