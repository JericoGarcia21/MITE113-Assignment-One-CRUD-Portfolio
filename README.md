# Student Manager — Laravel Classroom Series

A Laravel CRUD application built across four lessons, covering Eloquent models, relationships, resource controllers, and login-protected authorization.

---

## Lessons Covered

| Lesson | Topic |
|--------|-------|
| 1 | Laravel basics — routing, views, blade |
| 2 | Eloquent models & migrations |
| 3 | Eloquent relationships & complete CRUD |
| 4 | Authentication & authorization (this lesson) |

---

## Features

- **Student CRUD** — create, read, update, delete student records
- **Course relationship** — each student belongs to a course
- **Authentication** — session-based login/logout via `Auth::attempt()`
- **Authorization** — `StudentPolicy` ensures only the record owner can edit or delete
- **Route protection** — all student and course routes are wrapped in `auth` middleware
- **Conditional UI** — Edit/Delete buttons hidden from non-owners using `@can`

---

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm

---

## Setup

```bash
# 1. Install dependencies
composer install
npm install

# 2. Copy environment file and generate app key
cp .env.example .env
php artisan key:generate

# 3. Run migrations and seed default data
php artisan migrate:fresh --seed

# 4. Start the dev server
php artisan serve
```

Visit `http://localhost:8000` — you'll be redirected to `/login`.

---

## Seeded Test Accounts

All accounts use the password **`password`**.

| Name | Email | Owns |
|------|-------|------|
| Juan dela Cruz | `juan@example.com` | Pedro Reyes, Ana Lim |
| Maria Santos | `maria@example.com` | Carlo Villanueva |

### What to test

| Scenario | Steps | Expected result |
|----------|-------|-----------------|
| Guest blocked | Log out, visit `/students` directly | Redirected to `/login` |
| Owner can edit | Log in as Juan, open Pedro or Ana | Edit & Delete buttons visible |
| Non-owner blocked (UI) | Log in as Juan, open Carlo | Edit & Delete buttons hidden |
| Non-owner blocked (URL) | Log in as Juan, visit `/students/3/edit` | 403 Forbidden |
| Owner can delete | Log in as Maria, delete Carlo | Record removed, redirect to index |

---

## Project Structure

```
app/
├── Http/Controllers/
│   ├── AuthController.php       # login / logout
│   ├── StudentController.php    # CRUD + authorize()
│   └── CourseController.php
├── Models/
│   ├── Student.php              # belongsTo User, belongsTo Course
│   ├── Course.php
│   └── User.php
└── Policies/
    └── StudentPolicy.php        # update() and delete() owner check

database/
├── migrations/                  # includes add_user_id_to_students
└── seeders/
    └── DatabaseSeeder.php       # 2 users, 2 courses, 3 students

resources/views/
├── auth/login.blade.php
├── students/                    # index, show, create, edit — @can guards
├── courses/
└── components/layouts/app.blade.php   # navbar with @auth / @else

routes/web.php                   # login/logout + auth-wrapped resources
```

---

## Key Implementation Notes

**Policy discovery** — Laravel 11 auto-discovers `StudentPolicy` by naming convention. No manual registration needed.

**Ownership check** — `store()` sets `user_id = Auth::id()`. The policy compares `(int) $student->user_id === $user->id`.

**Double enforcement** — authorization is enforced in both the controller (`$this->authorize()`) and the view (`@can`). The controller is the security boundary; the view just improves UX.

**Login route name** — the named route `login` is what Laravel's `auth` middleware redirects guests to automatically.
