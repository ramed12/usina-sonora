<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSender extends Mailable
{
    use Queueable, SerializesModels;


    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject("Novo contato ".$this->data['subject']);
        $this->to($this->data['email'],$this->data['name']);
        return $this->markdown('mail.contactsend',['data' => $this->data]);
    }
}
