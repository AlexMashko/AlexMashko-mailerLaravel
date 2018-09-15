<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\MailClass;

class MailClass extends Mailable
{
    use Queueable, SerializesModels;
   // protected $name;
    protected $email;
    public $msg;
    public $subject;
    public $headers;
    //public $from;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $email, $subject, $msg, $headers)
    {
        
        
        $this->email=$email;
        $this->subject=$subject;      
        $this->msg=$msg;
        $this->headers=$headers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('auth.emails.contact-mail')
        ->with([
            'email' => $this->email,
            'subject' => $this->subject,
            'msg' => $this->msg,
            'headers' => $this->headers,

        ])
        ->subject($this->subject)->to($this->email);
    }
}
