# Task Management System

A Laravel-based mini task management system built for the Junior Fullstack Developer technical assessment.

Users can register, log in, create their own projects, manage tasks within those projects, and track progress from a dashboard with status summaries.

## Features

- User registration, login, and logout
- User-specific access control for projects and tasks
- Project CRUD
- Task CRUD within a project
- Task status validation using `To Do`, `In Progress`, and `Done`
- Task filtering by status with immediate auto-submit
- Dashboard summary cards for total projects, total tasks, and tasks by status
- Status-based UI colors for `To Do`, `In Progress`, and `Done`
- Logged-in username displayed in the header
- Responsive Blade + Tailwind interface
- Migrations, factories, seed data, and feature tests

## Tech Stack

- Laravel 12
- PHP 8.2+
- Blade
- Tailwind CSS 4
- Vite 7
- SQLite by default for local development
- MySQL-compatible schema for deployment or assessment review

## Database Design

Main tables:

- `users`
- `projects`
- `tasks`

Relationships:

- A user has many projects
- A project belongs to one user
- A project has many tasks
- A task belongs to one project

Foreign keys are enforced through migrations, and deleting a project cascades to its tasks.

## Quick Start

Run these commands from the project root:

```bash
composer install
copy .env.example .env
php artisan key:generate
npm install
php artisan migrate --seed
composer run dev
```

## Database Configuration

### SQLite

This project uses SQLite by default.

Make sure this file exists:

```bash
database/database.sqlite
```

Use this in `.env`:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

### MySQL

No application code changes are required to use MySQL. Update `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management_system
DB_USERNAME=root
DB_PASSWORD=
```

Then run:

```bash
php artisan migrate:fresh --seed
```

## Frontend Dependencies

Frontend packages are already declared in `package.json`. Main packages include:

- `vite`
- `laravel-vite-plugin`
- `tailwindcss`
- `@tailwindcss/vite`
- `axios`
- `concurrently`

Use Node.js 18 or newer.
Recommended version: Node 20 LTS.

## Development and Build

Start the full development environment:

```bash
composer run dev
```

This runs:

- Laravel development server
- Queue listener
- Log viewer
- Vite dev server

Build production assets only:

```bash
npm run build
```

## Demo Account

The seeder creates a demo account:

- Email: `admin@example.com`
- Password: `password`

The password comes from the default `UserFactory` value and is hashed automatically by Laravel.

## Testing

Run the test suite with:

```bash
php artisan test
```

Current feature coverage includes:

- Authentication
- Dashboard counts
- Project ownership and CRUD
- Task ownership, CRUD, and validation
- Task filtering behavior

## Notes

- Business logic is kept in controllers, models, enums, and form requests rather than views.
- Validation is handled server-side.
- The layout safely skips Vite asset loading when no build output exists yet, which helps in fresh local environments and during test runs.

## GitHub Checklist

Before pushing to GitHub:

- keep `.env` local and do not commit it
- commit `.env.example` as the environment template
- include migrations, seeders, factories, and updated documentation
- make sure the README matches the current seeded demo account and setup flow
