### Description of structural directories
- **app/**:
    - **Events/**:
    - **Http/**:
        - **Controllers/**:
        - **Requests/**:
        - **Trait/**:
    - **Jobs/**:
    - **Listeners/**:
    - **Models/**:
    - **Providers/**:
- **database/**:
    - **migrations/**:
- **routes/**:
    - **api/**:
- **tests/**:
    - **Feature/**:
    - **Unit/**:

- **TASK.md**: Description of the task
- **README.md**: Project documentation.
- **.env.example**:
  Example environment settings file to copy to `.env` to configure the project.

### Instructions for setting up the project
 - php 8.2
 - postgres 17.0
1. Clone the repository to your local machine:
```bash
git clone https://github.com/andrewspacecore/laravel_test_task_1_simple_api.git
```
 ```bash
git clone git@github.com:andrewspacecore/laravel_test_task_1_simple_api.git
```
2. Create an .env file based on .env.example and configure the environment (eg configure the database).
 ```bash
cp .env.example .env
 ```
3. Generate a new application key in Laravel
 ```bash
  php artisan key:generate
 ```
4. Installation of project dependencies
 ```bash
  composer install
 ```
5. Run migrations to create tables in the database
 ```bash
  php artisan migrate
 ```
6. Start a queue worker
 ```bash
  php artisan queue:work
 ```
7. Start test
 ```bash
  php artisan test
 ```

Send a POST request to api/submission/submit with the following JSON body:

```json
{
  "name": "John Doe",
  "email": "john.doe@example.com",
  "message": "This is a test message."
}
```
You should receive a response with the status code 202 indicating that the request is being processed.
