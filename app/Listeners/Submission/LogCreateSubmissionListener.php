<?php

namespace App\Listeners\Submission;

use App\Events\Submission\CreateSubmissionEvent;
use Illuminate\Support\Facades\Log;

class LogCreateSubmissionListener
{
    public function __construct()
    {
    }

    public function handle(CreateSubmissionEvent $event): void
    {
        $submission = $event->getSubmission();
        Log::info('Submission saved', ['name' => $submission->name, 'email' => $submission->email]);
    }
}
