<?php

namespace Tests\Feature\Submission;

use App\Jobs\Submission\CreateSubmissionJob;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Queue;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SubmissionTest extends TestCase
{
    use DatabaseTransactions;

    public function test_submission_submit_action_create_job()
    {
        Queue::fake();

        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        $response = $this->postJson('/api/submission/submit', $data);

        $response->assertStatus(202);
        Queue::assertPushed(CreateSubmissionJob::class, function ($job) use ($data) {
            return $job->getData()['name'] === $data['name'];
        });
    }

    public function test_submission_submit_action_successfully()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        $response = $this->postJson('/api/submission/submit', $data);

        $response->assertStatus(Response::HTTP_ACCEPTED)
            ->assertJson([
                'status' => Response::HTTP_ACCEPTED,
                'message' => 'Submission is being processed.'
            ]);
    }

    public function test_submission_submit_action_no_validation()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ];

        $response = $this->postJson('/api/submission/submit', $data);

        $response->assertStatus(422)
            ->assertJson(
                [
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'errors' => [
                        'message' => ['message is required']
                    ]
                ]
            );
    }
}
