<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

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
    //	foreach ($this->demo->hlavicka as $h) {
    //		echo $h;
    //		echo "<br>";
	//    }
    	//dd($this->demo->other);

        $this->subject = $this->demo->subject;
        $this->from[0]['name'] = $this->demo->sender;
        $this->from[0]['address'] = env('MAIL_FROM_ADDRESS', $this->demo->email);

        if($this->demo->mailType == "html"){
        	if($this->demo->sablona == "1") {
		        return $this->view('mails.demo2');
	        }
	        elseif($this->demo->sablona == "2") {

		        return $this->view('mails.demo3');
	        }

	        else {

		        return $this->view('mails.demo');
	        }
        } else{
            return $this->text('mails.demo_plain');
        }
    }
}