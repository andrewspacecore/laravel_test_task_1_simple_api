<?php

namespace App\Events\Submission;

use App\Models\Submission;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateSubmissionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param Submission $submission
     */
    public function __construct(protected Submission $submission)
    {
    }

    /**
     * @return Submission
     */
    public function getSubmission(): Submission
    {
        return $this->submission;
    }
}
