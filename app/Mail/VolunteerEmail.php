<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VolunteerEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(['address'=>env('MAIL_USERNAME', 'bolloomn@gmail.com'), 'name' => 'Баянхонгор'])
            ->subject($this->content['subject'])
            ->markdown('volunteer.emailbuild')
            ->with('content',$this->content);
    }
}
