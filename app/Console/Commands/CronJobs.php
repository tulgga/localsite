<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notification;
use App\Banks;
use App\Loan;

class CronJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word:minute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cronjobs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $time=date('H:i');

        //biction buurah
        if($time=='09:05' or $time=='13:00' or $time=='17:00'){
           $btc=Banks::btcInfo();
           if($btc['percent']<=-20){
               Notification::send(0, 'Биткойн ханшийн мэдээлэл','Биткойны ханш '.$btc['percent'].'% буурч '.$btc['last']. '$ боллоо.');
           }
        }

        //hugatsaa shalgah
        if($time=='09:00'){
            $loans=Loan::where('loan_status', 2)->whereDate('updated_at', '=', date('Y-m-d', strtotime("-3 days", time())))->get();
            foreach ($loans as $loan){
                Notification::send($loan->user_id, 'Зээлийн сануулга','Таны зээлийн хугацаа дуусахад 3 хоног үлдлээ.');
            }

            $loans=Loan::where('loan_status', 2)->whereDate('date(updated_at)', '=', date('Y-m-d', strtotime("-1 days", time())))->get();
            foreach ($loans as $loan){
                Notification::send($loan->user_id, 'Зээлийн сануулга','Таны зээлийн хугацаа дуусахад 1 хоног үлдлээ.');
            }


            $loans=Loan::where('loan_status', 4)->whereDate('date(updated_at)', '=', date('Y-m-d', strtotime("+1 days", time())))->get();
            foreach ($loans as $loan){
                Notification::send($loan->user_id, 'Зээлийн сануулга','Таны зээлийн хугацаа хэтэрсэн байна. Та '.date('Y-m-d', strtotime("+6 days",strtotime($loan->updated_at))).' (Зээлийн дууссан огнооноос хойш 7 хоног)-ны дотор зээлээ төлөхгүй бол барьцааг борлуулахыг анхаарна уу.');
            }
        }
    }
}
