<?php declare(strict_types=1);

namespace Tests\Unit\Submission;

use App\Events\Submission\CreateSubmissionEvent;
use App\Listeners\Submission\LogCreateSubmissionListener;
use App\Models\Submission;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class SubmissionTest extends TestCase
{
    use DatabaseTransactions;

    public function test_submission_can_be_created(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        $submission = Submission::create($data);

        $this->assertDatabaseHas('submissions', $data);
        $this->assertEquals('John Doe', $submission->name);
    }

    public function test_submission_saved_event_is_dispatched(): void
    {
        Event::fake();

        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        $submission = Submission::create($data);

        event(new CreateSubmissionEvent($submission));

        Event::assertDispatched(CreateSubmissionEvent::class, function ($event) use ($data) {
            return $event->getSubmission()['name'] === $data['name'];
        });
    }

    public function test_log_submission_listener_logs_message(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        $submission = Submission::create($data);

        Log::shouldReceive('info')->once()->with('Submission saved', ['name' => $submission->name, 'email' => $submission->email]);

        $listener = new LogCreateSubmissionListener();
        $event = new CreateSubmissionEvent($submission);

        $listener->handle($event);
    }
}
