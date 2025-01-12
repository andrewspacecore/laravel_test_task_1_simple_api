<?php

namespace App\Jobs\Submission;

use App\Events\Submission\CreateSubmissionEvent;
use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateSubmissionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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

    public function handle(): void
    {
        $submission = Submission::create($this->getData());
        event(new CreateSubmissionEvent($submission));
    }
}
