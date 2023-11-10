<?php

namespace App\Observers;

use App\Mail\SendWelcomeMail;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if (@$user->email && !$user->mobile)
            Mail::to($user->email)->send(new SendWelcomeMail($user->name));
        else
            (new SmsService())->send($user->mobile, 'Hello ' . $user->name);;
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
