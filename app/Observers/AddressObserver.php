<?php

namespace App\Observers;

use App\Models\Address;
use App\Models\AddressHistory;
use App\Models\Branch;

class AddressObserver
{
    /**
     * Handle the Address "created" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function created(Address $address)
    {
        $this->recordHistory($address, 'created');
    }

    /**
     * Handle the Address "updated" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function updated(Address $address)
    {
        $this->recordHistory($address, 'updated');
    }

    /**
     * Handle the Address "deleted" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function deleted(Address $address)
    {
        $this->recordHistory($address, 'deleted');
    }

    /**
     * Handle the Address "restored" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function restored(Address $address)
    {
        //
    }

    /**
     * Handle the Address "force deleted" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function forceDeleted(Address $address)
    {
        //
    }

    protected function recordHistory(Address $address, $event)
    {
        AddressHistory::create([
            'client_id' => $address->client_id,
            'user_id' => auth()->user()->id,
            'event' => $event,
            'yuridik_address' => $address->yuridik_address,
            'home_address' => $address->home_address,
            'company_location' => $address->company_location,
        ]);
    }
}
