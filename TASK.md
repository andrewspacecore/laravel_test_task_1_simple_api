# Simple Laravel API with Job Queue, Database, and Event Handling

## Objective

This Laravel API demonstrates the usage of job queues, database operations, migrations, and event handling. It includes the following features:
- A single API endpoint (`/submit`) for receiving user data.
- Storing data in the `submissions` table via a queued job.
- Triggering an event and logging a message when the submission is saved.

## Requirements

- **API Endpoint**:
    - Endpoint: `/submit`
    - Method: `POST`
    - JSON Payload:
      ```json
      {
          "name": "John Doe",
          "email": "john.doe@example.com",
          "message": "This is a test message."
      }
      ```

    - Validation: Ensure that `name`, `email`, and `message` are present.

- **Database Setup**:
    - Use Laravel migrations to create the `submissions` table with the following columns:
        - `id` (primary key)
        - `name` (string)
        - `email` (string)
        - `message` (text)
        - `created_at` (timestamp)
        - `updated_at` (timestamp)

- **Job Queue**:
    - On receiving the request, dispatch a job to save the data to the database.

- **Event Handling**:
    - Trigger an event called `SubmissionSaved` once the data is saved.
    - The event will be logged using a listener that logs a message with the `name` and `email` of the saved submission.
    - Return appropriate status codes for invalid inputs and any errors that occur during the job processing.
- **Documentation**: Briefly document the following in a README file:
    - Instructions on setting up the project and running migrations.
    - A simple explanation of how to test the API endpoint.
- **Test**:
    - Write a simple Unit test.
- **Deliverables**:
    - Source code for the Laravel project, including all migrations, models, controllers, jobs, and event classes.
    - A README file with setup and testing instructions.
- **Submission Instructions**:
    - Please submit your project as a link to a GitHub repository. Ensure that any necessary setup instructions are included in your README to facilitate the review of your project.
