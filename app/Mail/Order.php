<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Order extends Mailable
{
    use Queueable, SerializesModels;
    
    public $client;
    public $email;
    public $details;
    public $product_names;

    public function __construct($client, $email, $details, $product_names)
    {
        $this->client = $client;
        $this->email = $email;
        $this->details = $details;
        $this->product_names = $product_names;
    }

    public function build()
    {
        return $this->view('emails.order');
    }
}
