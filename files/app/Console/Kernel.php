<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        // 5 day notice

        $schedule->call(function () {


            $FiveDaystoGo = \Carbon\Carbon::now()->addDays(5)->format("Y-m-d");

            $usertools = \App\Models\Tool::where("retag_date","=",$FiveDaystoGo)->where("five_notice","=","0")->get();

            foreach($usertools as $tool){

                $notification = new \App\Models\Notification();  
                $notification->message = '<a href="'.url("industryProject/public/tools/".$tool -> id).'">'.$tool -> name.'</a>'." is due for re-tagging within the next five days.";
                $notification->user_id = $tool->user_id;
                $notification->save();

                $tool -> five_notice = 1;
                $tool -> save();
            }

             //send email

            Mail::send('emails.fiveNotice', ['tool' => $tool], function ($m) {
                $m->from('leanne.abarro@gmail.com', 'Tag and Track');
                $m->to('leanne.abarro@gmail.com', 'Leanne')->subject('Tool is due to be re-tagged.');
            });
       
        })->dailyAt('04:00');

        // 3 day notice
        
        $schedule->call(function () {


            $ThreeDaystoGo = \Carbon\Carbon::now()->addDays(3)->format("Y-m-d");

            $usertools = \App\Models\Tool::where("retag_date","=",$ThreeDaystoGo)->where("three_notice","=","0")->get();

            foreach($usertools as $tool){

                $notification = new \App\Models\Notification();  
                $notification->message = '<a href="'.url("industryProject/public/tools/".$tool -> id).'">'.$tool -> name.'</a>'." is due for re-tagging within the next three days.";
                $notification->user_id = $tool->user_id;
                $notification->save();

                $tool -> three_notice = 1;
                $tool -> save();
            }

             //send email

            Mail::send('emails.threeNotice', ['tool' => $tool], function ($m) {
                $m->from('leanne.abarro@gmail.com', 'Tag and Track');
                $m->to('leanne.abarro@gmail.com', 'Leanne')->subject('Tool is due to be re-tagged.');
            });
       
        })->dailyAt('05:00');

        // 1 day notice
        
        $schedule->call(function () {


            $OneDaytoGo = \Carbon\Carbon::now()->addDays(1)->format("Y-m-d");

            $usertools = \App\Models\Tool::where("retag_date","=",$OneDaytoGo)->where("one_notice","=","0")->get();

            foreach($usertools as $tool){

                $notification = new \App\Models\Notification();  
                $notification->message = '<a href="'.url("industryProject/public/tools/".$tool -> id).'">'.$tool -> name.'</a>'." is due for re-tagging tomorrow.";
                $notification->user_id = $tool->user_id;
                $notification->save();

                $tool -> one_notice = 1;
                $tool -> save();
            }

             //send email

            Mail::send('emails.oneNotice', ['tool' => $tool], function ($m) {
                $m->from('leanne.abarro@gmail.com', 'Tag and Track');
                $m->to('leanne.abarro@gmail.com', 'Leanne')->subject('Tool is due to be re-tagged.');
            });
       
        })->dailyAt('06:00');

    }
}
