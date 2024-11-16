<?php

namespace App\Jobs;

use App\Models\Document;
use App\Models\Pollstation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class HandleUploadDocument implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue;

    public $request;
    /**
     * Create a new job instance.
     */
    public function __construct(
        $request
    ) {
        $this->request = $request;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('test');
        if ($this->request['document']) {
            Log::info('running upload job');
            $pollstationId = $this->request['pollstationID'];
            $document = Document::where('documentable_id', $pollstationId)
                ->where('documentable_type', Pollstation::class)
                ->first();

            // Generate random filename
            $file = $this->request['document'];
            $randomFileName = $file->hashName();
            $originalFileName = $file->getClientOriginalName();
            Log::info("Uploaded $randomFileName");

            if ($document) {
                // Hapus file lama
                if (Storage::exists($document->document_path)) {
                    Storage::delete($document->document_path);
                }

                // Upload ulang file dengan nama random
                $file->store('document', 'public');

                // Update path file di database
                $document->update([
                    'document_path' => "storage/document/$randomFileName",
                    'document_name' => $originalFileName,
                    'updated_at' => now(),
                ]);
            } else {
                // Upload file baru dengan nama random
                $file->store('document', 'public');

                // Simpan entri baru ke table documents
                Document::create([
                    'documentable_id' => $pollstationId,
                    'documentable_type' => Pollstation::class,
                    'document_path' => "storage/document/$randomFileName",
                    'document_name' => $originalFileName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            Log::info('Job Success');
        }
    }
}
