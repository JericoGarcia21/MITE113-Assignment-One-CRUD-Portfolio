# Student Manager — Laravel Classroom Series

A Laravel CRUD application built across five lessons, covering Eloquent models, relationships, resource controllers, login-protected authorization, and a token-protected REST API via Sanctum.

---

## Lessons Covered

| Lesson | Topic |
|--------|-------|
| 1 | Laravel basics — routing, views, blade |
| 2 | Eloquent models & migrations |
| 3 | Eloquent relationships & complete CRUD |
| 4 | Authentication & authorization |
| 5 | Token-protected API with Laravel Sanctum |

---

## Features

- **Student CRUD** — create, read, update, delete student records
- **Course relationship** — each student belongs to a course
- **Session auth** — browser login/logout via `Auth::attempt()`
- **Authorization** — `StudentPolicy` ensures only the record owner can edit or delete
- **Route protection** — all web routes wrapped in `auth` middleware; API routes in `auth:sanctum`
- **Conditional UI** — Edit/Delete buttons hidden from non-owners using `@can`
- **REST API** — JSON endpoints for students, protected by Sanctum bearer tokens
- **Token scoping** — `reports:read` tokens can read but are blocked from write operations
- **Token revocation** — `POST /api/logout` deletes the current token immediately

---

## Requirements

- PHP 8.3+
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

---

## Web — What to Test (Lesson 4)

| Scenario | Steps | Expected |
|----------|-------|----------|
| Guest blocked | Log out, visit `/students` directly | Redirected to `/login` |
| Owner can edit | Log in as Juan, open Pedro or Ana | Edit & Delete buttons visible |
| Non-owner blocked (UI) | Log in as Juan, open Carlo | Edit & Delete buttons hidden |
| Non-owner blocked (URL) | Log in as Juan, visit `/students/3/edit` | 403 Forbidden |
| Owner can delete | Log in as Maria, delete Carlo | Record removed, redirected to index |

---

## API — What to Test (Lesson 5)

Base URL: `http://localhost:8000/api`

### 1. No token → 401

```bash
curl http://localhost:8000/api/students
```

### 2. Issue a full-access token

```bash
curl -X POST http://localhost:8000/api/tokens/create \
  -H "Content-Type: application/json" \
  -d '{"email":"juan@example.com","password":"password","device_name":"postman"}'
# returns: { "token": "<plaintext-token>" }
```

### 3. Use the token → 200

```bash
curl http://localhost:8000/api/students \
  -H "Authorization: Bearer <token>"
```

### 4. Issue a scoped reports:read token

```bash
curl -X POST http://localhost:8000/api/tokens/create \
  -H "Content-Type: application/json" \
  -d '{"email":"juan@example.com","password":"password","abilities":["reports:read"]}'
```

### 5. Scoped token blocked from write routes → 403

```bash
curl -X DELETE http://localhost:8000/api/students/1 \
  -H "Authorization: Bearer <scoped-token>"
```

### 6. Revoke token

```bash
curl -X POST http://localhost:8000/api/logout \
  -H "Authorization: Bearer <token>"
# returns: { "message": "Token revoked." }
```

### 7. Revoked token no longer works → 401

```bash
curl http://localhost:8000/api/students \
  -H "Authorization: Bearer <token>"
```

---

## API Endpoints

| Method | Endpoint | Auth | Description |
|--------|----------|------|-------------|
| `POST` | `/api/tokens/create` | Public | Issue a bearer token |
| `POST` | `/api/logout` | Bearer | Revoke current token |
| `GET` | `/api/students` | Bearer | List all students (paginated) |
| `GET` | `/api/students/{id}` | Bearer | Get a single student |
| `POST` | `/api/students` | Bearer (`*`) | Create a student |
| `PUT` | `/api/students/{id}` | Bearer (`*`) | Update a student (owner only) |
| `DELETE` | `/api/students/{id}` | Bearer (`*`) | Delete a student (owner only) |

> `reports:read` tokens can only call `GET` endpoints. Write routes require a full `*` token.
> `bio` and `skills` fields are only returned when the token has `reports:read` or `*` ability.

---

## Project Structure

```
app/
├── Http/Controllers/
│   ├── Api/
│   │   ├── TokenController.php  # issue + revoke tokens
│   │   └── StudentController.php  # API CRUD
│   ├── AuthController.php       # web login / logout
│   ├── StudentController.php    # web CRUD + authorize()
│   └── CourseController.php
├── Http/Resources/
│   └── StudentResource.php      # JSON shape + tokenCan() field gating
├── Models/
│   ├── Student.php              # belongsTo User, belongsTo Course
│   ├── Course.php
│   └── User.php                 # HasApiTokens, HasFactory, Notifiable
└── Policies/
    └── StudentPolicy.php        # update() and delete() owner check

database/
├── migrations/                  # includes personal_access_tokens, user_id on students
└── seeders/
    └── DatabaseSeeder.php       # 2 users, 2 courses, 3 students

resources/views/
├── auth/login.blade.php
├── students/                    # index, show, create, edit — @can guards
├── courses/
└── components/layouts/app.blade.php   # navbar with @auth dropdown

routes/
├── web.php                      # login/logout + auth-wrapped resource routes
└── api.php                      # Sanctum-protected student + token routes
```

---

## Key Implementation Notes

**Policy discovery** — Laravel 11 auto-discovers `StudentPolicy` by naming convention. No manual registration needed.

**Ownership check** — `store()` sets `user_id = Auth::id()` (web) or `$request->user()->id` (API). The policy compares `(int) $student->user_id === $user->id`.

**Token scoping** — abilities are checked with `$request->user()->tokenCan('*')` before any write. `StudentResource` gates `bio` and `skills` behind `tokenCan('reports:read')`.

**Token revocation** — `currentAccessToken()->delete()` removes the row from `personal_access_tokens`. The token is invalid on the very next request.

**Double enforcement (web)** — authorization is in both the controller (`$this->authorize()`) and the view (`@can`). Controller is the security boundary; view is UX.
