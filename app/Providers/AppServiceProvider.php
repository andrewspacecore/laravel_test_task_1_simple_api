<?php

namespace App\Providers;

use App\Events\Submission\CreateSubmissionEvent;
use App\Listeners\Submission\LogCreateSubmissionListener;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            CreateSubmissionEvent::class,
            LogCreateSubmissionListener::class,
        );

        Event::listen(JobFailed::class, function (JobFailed $event) {
            Log::error("Job failed", [
                'connection' => $event->connectionName,
                'job' => $event->job->resolveName(),
                'exception' => $event->exception->getMessage(),
            ]);
        });
    }
}
