<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp;
use Illuminate\Support\Facades\Log;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message,$number;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message,$number)
    {
        $this->message = $message;
        $this->number = $number;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            $mobilenumber = (string)((int)($this->number));
            $client = new \GuzzleHttp\Client();

            $phone_number = $mobilenumber;
            if(substr( $mobilenumber, 0, 3 ) !== "966"){
                $phone_number = '966' . $mobilenumber;
            }

            $client->get('https://api.goinfinito.me/' . $phone_number . '&text=' . $this->message);
        }catch (\Exception $e){
            Log::info('error while sending message to ' . $this->number);
        }
    }
}
