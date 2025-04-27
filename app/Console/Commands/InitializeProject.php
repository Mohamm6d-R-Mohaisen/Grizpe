<?php

namespace App\Console\Commands;

use App\Models\PaymentGateway;
use App\Models\Subscription;
use App\Services\Payment\StripeDirectChargeService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class InitializeProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Project initialization';
    
    protected $stripeChargeService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(StripeDirectChargeService $stripeChargeService)
    {
        $this->stripeChargeService = $stripeChargeService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('migrate:fresh');
        $this->call('db:seed');
        $this->call('config:clear');
        // $this->call('passport:install');
        $this->call('passport:client', ['--personal' => true]);
        DB::table('oauth_clients')->where('id',1)->update([
            'secret' => 'bF1p55BdhagpuCCFDeRxwJY2zWo7xTKZieDrQ4f1'
        ]);

        session()->forget('cart');
       
        $this->call('storage:link');
        
        // $this->call('schedule:work');

        $this->info(Artisan::output());

        return Command::SUCCESS;
    }

    // protected function getChargeAndTransfer()
    // {
    //     $payment_gateway = PaymentGateway::first();
    //     $credentials = json_decode(decrypt($payment_gateway->credentials), true);
    //     $stripe_secret_key = $credentials['STRIPE_SECRET'];

    //     try {
    //         // خصم 50 دولارًا وتحويلها إلى حساب الـ Super Admin
    //         $this->stripeChargeService->chargeAndTransfer(
    //             50, // المبلغ بالدولار
    //             'usd', // العملة
    //             $stripe_secret_key, // توكن العميل
    //             env('SUPER_ADMIN_STRIPE_ACCOUNT_ID') // حساب Super Admin
    //         );

    //         Subscription::create([
    //             'next_payment_date' => Carbon::now()->addMonth(),
    //         ]);
            
    //         return response()->json(['success' => 'تم تثبيت المتجر بنجاح وتم خصم الرسوم.'], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }
}
