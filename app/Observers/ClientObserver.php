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
            'client_id' => $client->id ?? 1,
            'user_id' => auth()->user()->id ?? 1,
            'event' => $event ?? null,
            'mijoz_turi' => $client->mijoz_turi ?? null,
            'first_name' => $client->first_name ?? null,
            'last_name' => $client->last_name ?? null,
            'father_name' => $client->father_name ?? null,
            'contact' => $client->contact ?? null,
            'is_deleted' => $client->is_deleted ?? null,
            'status' => $client->status ?? null,
            'client_description' => $client->client_description ?? null,
        ]);
    }
}
