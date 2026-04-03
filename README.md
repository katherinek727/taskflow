# TaskFlow

A clean, minimal task management application built with Laravel.

## Features

- Full CRUD — create, read, update, delete tasks
- Task statuses: New, In Progress, Completed
- Search tasks by title
- Filter tasks by status
- Pagination (10 per page)
- Server-side validation with inline error messages
- Modern dark UI with glassmorphism design system

## Tech Stack

- PHP 8.2+ / Laravel 11
- Blade templating
- SQLite (default) or any Laravel-supported database

## Setup

```bash
# 1. Clone the repository
git clone https://github.com/your-username/taskflow.git
cd taskflow

# 2. Install dependencies
composer install

# 3. Environment setup
cp .env.example .env
php artisan key:generate

# 4. Configure database
# SQLite (default — no extra setup needed):
# Ensure .env has: DB_CONNECTION=sqlite
# The database file is already at database/database.sqlite

# 5. Run migrations
php artisan migrate

# 6. Start the server
php artisan serve
```

Visit [http://localhost:8000](http://localhost:8000)

## Task Fields

| Field         | Type      | Notes                               |
|---------------|-----------|-------------------------------------|
| `id`          | integer   | Auto-increment primary key          |
| `title`       | string    | Required, max 255 chars             |
| `description` | text      | Optional                            |
| `status`      | enum      | `new` / `in_progress` / `completed` |
| `created_at`  | timestamp | Auto-managed by Laravel             |
| `updated_at`  | timestamp | Auto-managed by Laravel             |

## Project Structure

```
app/
  Http/Controllers/TaskController.php   # CRUD logic with search & filter
  Models/Task.php                       # Eloquent model with status constants
database/
  migrations/                           # Tasks table migration
resources/views/
  layouts/app.blade.php                 # Main layout & design system
  tasks/
    index.blade.php                     # Task list with search/filter/pagination
    show.blade.php                      # Task detail page
    create.blade.php                    # Create form
    edit.blade.php                      # Edit form
    _form.blade.php                     # Shared form partial
routes/
  web.php                               # Resource routes with root redirect
```

## Git History

```
chore: initialise Laravel project
feat(db): add tasks table migration with status enum
feat(model): add Task model with fillable fields and status constants
feat(controller): implement TaskController with full CRUD, search, and filter
feat(routes): register task resource routes with root redirect
feat(ui): add app layout with custom dark glassmorphism design system
feat(views): add index, show, create, edit views and shared form partial
docs: add README with setup instructions and project structure
```
