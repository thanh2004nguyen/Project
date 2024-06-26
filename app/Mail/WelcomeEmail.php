<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;


class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;

    // Your code for the mailable class goes here
    // ...

    public $voucherCode;
    public function __construct(User $user )
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Welcome to MARUFUIRT Website!')
        ->view('pages.mail.welcome');
    }
}