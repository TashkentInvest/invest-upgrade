<?php

namespace App\Observers;

use App\Models\Passport;
use App\Models\PassportHistory;

class PassportObserver
{
    /**
     * Handle the Passport "created" event.
     *
     * @param  \App\Models\Passport  $passport
     * @return void
     */
    public function created(Passport $passport)
    {
        $this->recordHistory($passport, 'created');
        
    }

    /**
     * Handle the Passport "updated" event.
     *
     * @param  \App\Models\Passport  $passport
     * @return void
     */
    public function updated(Passport $passport)
    {
        $this->recordHistory($passport, 'updated');
        
    }

    /**
     * Handle the Passport "deleted" event.
     *
     * @param  \App\Models\Passport  $passport
     * @return void
     */
    public function deleted(Passport $passport)
    {
        $this->recordHistory($passport, 'deleted');
        
    }

    /**
     * Handle the Passport "restored" event.
     *
     * @param  \App\Models\Passport  $passport
     * @return void
     */
    public function restored(Passport $passport)
    {
        //
    }

    /**
     * Handle the Passport "force deleted" event.
     *
     * @param  \App\Models\Passport  $passport
     * @return void
     */
    public function forceDeleted(Passport $passport)
    {
        //
    }

    protected function recordHistory(Passport $passport, $event)
    {
        PassportHistory::create([
            'client_id' => $passport->client_id,
            'user_id' => auth()->user()->id,
            'event' => $event,
            'passport_serial' => $passport->passport_serial,
            'passport_pinfl' => $passport->passport_pinfl,
            'passport_date' => $passport->passport_date,
            'passport_location' => $passport->passport_location,
            'passport_type' => $passport->passport_type,
        ]);
    }
}
