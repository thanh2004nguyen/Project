<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VoucherEmail extends Mailable
{
    use Queueable, SerializesModels;

    // Your code for the mailable class goes here
    // ...

    public $voucherCode;
    public function __construct($voucherCode)
    {
        $this->voucherCode = $voucherCode;
    }

    public function build()
    {
        // Build the email content
        return $this->view('pages.mail.voucher');
    }
}