## Requirement
Laravel 10.x requires a minimum PHP version of 8.1.

## How to install

- Clone repository `git@github.com:imyuvii/task-management.git`
- Go to the directory `cd task-management`
- Run `composer install`, Make sure you're running on PHP 8.1+
- Copy `.env.example` to `.env`
- Configure your database connection
- Run migration `php artisan migrate`
- Run database seeder `php artisan db:seed`
- Run the server `php artisan serve`

## How to use application
### Curl calls
- Login
```
curl --location --request POST 'http://localhost:8000/api/login' \
--header 'Content-Type: application/json' \
--data-raw '{
    "email": "john@example.com",
    "password": "JohnDoe123"
}'
```
- Register
```
curl --location --request POST 'http://localhost:8000/api/register' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "JohnDoe123",
}' 
```
- Get Tasks: Get all the tasks, You can supply filters in query string
```
curl --location 'http://127.0.0.1:8000/api/tasks?notes=1&due_date=2023-05-15&priority=High&status=New' \
--header 'Authorization: Bearer 11|uGkcxHRz1p5e3GzSEnzVd8aizV4OnHtG7Mjh16bj' \
--header 'Content-Type: application/json' \
```
- Create Task
```
curl --location 'http://127.0.0.1:8000/api/task/create' \
--header 'Authorization: Bearer 11|uGkcxHRz1p5e3GzSEnzVd8aizV4OnHtG7Mjh16bj' \
--form 'subject="Test Subject 22"' \
--form 'description="Lorem Ipsum Lorem Ipsum"' \
--form 'start_date="2023-01-01"' \
--form 'end_date="2023-05-18"' \
--form 'status="New"' \
--form 'priority="Low"' \
--form 'notes[0][subject]="Test"' \
--form 'notes[0][attachment][]=@"/Users/imyuvii/Downloads/Trade-History_02-05-2023 (1).csv"' \
--form 'notes[0][note]="Note: Lorem ipsum lorem ipsum"' \
--form 'notes[1][subject]="Subject 2"' \
--form 'notes[1][note]="Test Note 2"' \
--form 'notes[1][attachment][]=@"/path/to/file"' \
--form 'notes[2][subject]="Test subject"' \
--form 'notes[2][note]="test Note"' \
--form 'notes[2][attachment]=@"/Users/imyuvii/Downloads/Trade-History_02-05-2023 (1).csv"'
```

### Import postman collection & environment attached in `postman` directory under the root of the project
- Import collection from the project root directory `postman/API.postman_collection.json` and Environment `postman/Environment.postman_environment.json`
