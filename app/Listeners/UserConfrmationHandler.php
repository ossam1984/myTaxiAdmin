<?php

namespace App\Listeners;

use App\Events\UserConfmation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserConfrmationHandler
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
     * @param  UserConfmation  $event
     * @return void
     */
    public function handle(UserConfmation $event)
    {
        //
        
    }
}
