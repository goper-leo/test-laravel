<?php

namespace App\Observers;

use App\Models\Invitation;
use App\Mail\SignupInvitation;
use Mail;

class InvitationObserver
{
    /**
     * Handle the invitation "created" event.
     *
     * @param  \App\Invitation  $invitation
     * @return void
     */
    public function created(Invitation $invitation)
    {
        // Send invitation on this email
        Mail::to($invitation->email)->send(new SignupInvitation($invitation));
    }

    /**
     * Handle the invitation "updated" event.
     *
     * @param  \App\Invitation  $invitation
     * @return void
     */
    public function updated(Invitation $invitation)
    {
        //
    }

    /**
     * Handle the invitation "deleted" event.
     *
     * @param  \App\Invitation  $invitation
     * @return void
     */
    public function deleted(Invitation $invitation)
    {
        //
    }

    /**
     * Handle the invitation "restored" event.
     *
     * @param  \App\Invitation  $invitation
     * @return void
     */
    public function restored(Invitation $invitation)
    {
        //
    }

    /**
     * Handle the invitation "force deleted" event.
     *
     * @param  \App\Invitation  $invitation
     * @return void
     */
    public function forceDeleted(Invitation $invitation)
    {
        //
    }
}
