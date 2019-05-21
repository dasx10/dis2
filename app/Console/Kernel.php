<?php

namespace App\Console;

use App\Model\Admins\Admins;
use App\Model\Clients\ClientsData;
use App\Model\Points\Points;
use App\Model\Prize\Prize;
use function GuzzleHttp\Psr7\str;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Model\Logs\Logs;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $super_admin_email = Admins::where('role','=','super_admin')->value('email');
        if($super_admin_email) {
            $schedule->call(function () {
                $array_global = [
                    ['Name', 'Role', 'Text', 'Date']
                ];
                $logs_model = new Logs();
                $admins = $logs_model->get_admins();
                foreach ($admins as $admin) {
                    $array_put = [
                        ['Name', 'Role', 'Text', 'Date']
                    ];
                    $logs_arr = Logs::where('admins_id', '=', $admin->id)->orderBy('created_at', 'DESC')->get();
                    foreach ($logs_arr as $log_data) {
                        $array_global[] = [$admin->name, $admin->role, $log_data->text, date('F j, Y, g:i a', strtotime($log_data->created_at))];
                        $array_put[] = [$admin->name, $admin->role, $log_data->text, date('F j, Y, g:i a', strtotime($log_data->created_at))];
                    }
                    if (count($array_put) > 1) {
                        $link = $logs_model->upload_file($array_put);
                        $admin->link = $link;
                    } else {
                        $admin->link = '';
                    }
                }
                $glob_link = $logs_model->upload_file($array_global);
                Mail::send('email.logs', ['global'=>$glob_link,'admins'=>$admins], function ($message) {
                    $super_admin_email = Admins::where('role','=','super_admin')->value('email');
                    $message->from('dis@yobibyte.in.ua', 'Dis');
                    $message->to($super_admin_email);
                });
            })->dailyAt('21:00');
        }

        $schedule->call(function () {
            $points = Points::where('end_date','!=','')
                ->get();
            foreach ($points as $point) {
                if (date('m/d/Y') == strtotime($point->end_date)) {
                    $users_point = ClientsData::where('id','=',$point->users_id)->value('dis_points');
                    if($users_point-$point->count>=0){
                        ClientsData::where('id','=',$point->users_id)->decrement('dis_points',$point->count);
                    }
                    Points::where('id', '=', $point->id)
                        ->delete();
                }
            }
            
            $prizes = Prize::get();
            foreach ($prizes as $prize) {
                if(strtotime($prize->points)==date('m/d/Y')){
                    Prize::where('id','=',$prize->id)->delete();
                }
            }



        })->daily();


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
