<?php

namespace App\Observers;

use App\Models\File;
use App\Models\FileHistory;

class FileObserver
{
    /**
     * Handle the File "created" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function created(File $file)
    {
        $this->recordHistory($file, 'created');
        
    }

    /**
     * Handle the File "updated" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function updated(File $file)
    {
        $this->recordHistory($file, 'updated');
        
    }

    /**
     * Handle the File "deleted" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function deleted(File $file)
    {
        $this->recordHistory($file, 'deleted');
        
    }

    /**
     * Handle the File "restored" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function restored(File $file)
    {
        //
    }

    /**
     * Handle the File "force deleted" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function forceDeleted(File $file)
    {
        //
    }

    protected function recordHistory(File $file, $event)
    {
        FileHistory::create([
            'client_id' => $file->id,
            'user_id' => auth()->user()->id,
            'event' => $event,
            'path' => $file->path,
        ]);
    }
}
