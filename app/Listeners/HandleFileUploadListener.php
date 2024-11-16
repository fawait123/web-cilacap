<?php

namespace App\Listeners;

use App\Events\FileUploadEvent;
use App\Jobs\HandleUploadDocument;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleFileUploadListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FileUploadEvent $event): void
    {
        // Dispatch the job to handle file upload asynchronously
        HandleUploadDocument::dispatch($event->uploadedFile, $event->pollstationID);
    }
}
