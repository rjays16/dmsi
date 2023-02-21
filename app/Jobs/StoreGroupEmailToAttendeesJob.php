<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Attendees;

use Illuminate\Support\Facades\Mail;
use App\Mail\ThankYouMail;

class StoreGroupEmailToAttendeesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $attendee;

    public function __construct(Attendees $attendee, User $user)
    {
        $this->user = $user;
        $this->attendee = $attendee;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $this->attendee->save();
        $this->user['string_pw'] = 'password123';
        Mail::to($this->user['email'])->send(new ThankYouMail($this->user));
    }
}
