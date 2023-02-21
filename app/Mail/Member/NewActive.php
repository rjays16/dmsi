<?php

namespace App\Mail\Member;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewActive extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $prc_member;
    public function __construct($prc_member) {
        $this->prc_member = $prc_member;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('mails.member.newactive')->subject("Active Member");
    }    
}