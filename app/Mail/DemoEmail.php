<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DemoEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The demo object instance.
     *
     * @var Demo
     */
    public $demo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($demo)
    {
        $this->demo = $demo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this);
        $this->subject = "Webove technologie 2: virtualny server - prihlasovacie udaje";
        $this->from[0]['name'] = $this->demo->sender;
        $this->from[0]['address'] = env('MAIL_FROM_ADDRESS', 'xdano@stuba.sk');
        if($this->demo->mailType == "html"){
            //dd($this);
            return $this->view('mails.demo');
        } else{
            //dd($this->from[0]['name']);
            return $this->text('mails.demo_plain');
        }
    }
}