<?php

namespace App\Console\Commands;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use App\Http\Controllers\CheckoutController;

use Illuminate\Console\Command;
use App\Mail\BirthdayVoucherEmail;
use Illuminate\Support\Facades\Mail;

class CheckBirthdayCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-birthday-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now()->format('m-d');

        $users = User::whereRaw("DATE_FORMAT(birthday, '%m-%d') = '$today'")
        ->get();

      

    foreach ($users as $user) {
        
        $checkoutController = new CheckoutController();
        $voucherCode =  $checkoutController->generateVoucherCode();
        $expirationDate = now()->addDays(60);
        // Create voucher record
        $voucher = new Voucher();
        $voucher->code = $voucherCode;
        $voucher->type = 2;
        $voucher->name = "Birthday Voucher";
        $voucher->discount = 30;
        $voucher->discounttype = 2;
        $voucher->user_id = $user ->id ;
        $voucher->expiration_date = $expirationDate;
        $voucher->save();
        $userEmail = $user->email;
        Mail::to($userEmail)->send(new BirthdayVoucherEmail($voucherCode));
      
    }
}
}

