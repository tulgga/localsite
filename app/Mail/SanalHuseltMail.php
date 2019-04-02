<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SanalHuseltMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $SanalHuseltMail;
    public $title;

    public function __construct($SanalHuseltMail, $title)
    {
        $this->title=$title;
        $this->SanalHuseltMail=$SanalHuseltMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title)->from(['address'=>'info@bayankhongor.gov.mn', 'name' => 'Баянхонгор'])->view('mails.mail');
    }
}
