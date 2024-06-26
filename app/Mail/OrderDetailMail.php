<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Order;

class OrderDetailMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $order;

    public function __construct(User $user, Order $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Order Detail')
            ->view('pages.mail.order_detail');
    }
}