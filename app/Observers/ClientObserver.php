<?php

namespace App\Observers;

use App\Models\Client;
use App\Models\ClientHistory;

class ClientObserver
{
    /**
     * Handle the Client "created" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function created(Client $client)
    {
        $this->recordHistory($client, 'created');

    }

    /**
     * Handle the Client "updated" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function updated(Client $client)
    {
        $this->recordHistory($client, 'updated');
        
    }

    /**
     * Handle the Client "deleted" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function deleted(Client $client)
    {
        $this->recordHistory($client, 'deleted');
    }

    /**
     * Handle the Client "restored" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function restored(Client $client)
    {
        //
    }

    /**
     * Handle the Client "force deleted" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function forceDeleted(Client $client)
    {
        //
    }

    protected function recordHistory(Client $client, $event)
    {
        ClientHistory::create([
            'client_id' => $client->id,
            'user_id' => auth()->user()->id,
            'event' => $event,
            'mijoz_turi' => $client->mijoz_turi,
            'first_name' => $client->first_name,
            'last_name' => $client->last_name,
            'father_name' => $client->father_name,
            'contact' => $client->contact,
            'is_deleted' => $client->is_deleted,
            'status' => $client->status,
            'client_description' => $client->client_description,
        ]);
    }
}
