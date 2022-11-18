<?php

namespace App\Listeners;

use App\Events\VerifyAccountEvent;
use App\Mail\VerifySingerRegister;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class VerifyAccountListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\VerifyAccountEvent  $event
     * @return void
     */
    public function handle(VerifyAccountEvent $event)
    {
        $user = $event->user;
        Mail::to($user->email)->send(new VerifySingerRegister($user));
    }
}
