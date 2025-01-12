<?php

namespace App\Jobs\Submission;

use App\Events\Submission\CreateSubmissionEvent;
use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateSubmissionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $tries = 10;
    protected int $retryAfter = 30;

    /**
     * @param array $data
     */
    public function __construct(protected array $data)
    {
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @throws \Exception
     */
    public function handle(): void
    {
        try {
            $submission = Submission::create($this->getData());
            event(new CreateSubmissionEvent($submission));
        } catch (\Exception $e) {
            Log::error('Error processing create submission job: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * @param \Exception $e
     */
    public function failed(\Exception $e): void
    {
        Log::error("Create submission job failed: " . $e->getMessage());
    }
}
