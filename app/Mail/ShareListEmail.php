<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShareListEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $link;

    protected $name;

    protected $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($link, $name, $status)
    {
        $this->link = $link;
        $this->name = $name;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$link = route('user.activate', $this->user->remember_token);
        return $this->view('auth.emailShare')->with([
            'name' => $this->name,
            'link' => $this->link,
            'status' => $this->status
        ]);
    }
}
