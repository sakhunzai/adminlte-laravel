<?php

namespace App\Listeners;

use App\User;
use App\Clinic;
use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;


class EmailVerificationCode
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {

        $user = User::find($event->userId);
        
        if( 0==$user->is_verified && '' != $user->verification_code)
        {
            $register=config('adminlte.auth.register');

            $subject=$register['verification']['subject'];

            Mail::send($register['verification']['template'],['verification_code'=>$user->verification_code],
                function($message) use ($user,$subject) {
                    $message->to($user->email,$user->name);
                    $message->subject($subject);
            });
            
            $user->save();
        }
    }
}
