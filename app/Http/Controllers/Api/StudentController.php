<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentController extends Controller
{
    /** GET /api/students */
    public function index(): AnonymousResourceCollection
    {
        $students = Student::with('course')->latest()->paginate(15);

        return StudentResource::collection($students);
    }

    /** GET /api/students/{student} */
    public function show(Student $student): StudentResource
    {
        $student->load('course');

        return new StudentResource($student);
    }

    /** POST /api/students */
    public function store(Request $request): JsonResponse
    {
        // Write routes require a full-access token, not a scoped reports:read token
        if (! $request->user()->tokenCan('*')) {
            return response()->json(['message' => 'This token does not have permission to create students.'], 403);
        }

        $data = $this->validatedData($request);
        $data['user_id'] = $request->user()->id;

        $student = Student::create($data);

        return (new StudentResource($student->load('course')))
            ->response()
            ->setStatusCode(201);
    }

    /** PUT /api/students/{student} */
    public function update(Request $request, Student $student): StudentResource
    {
        $this->authorize('update', $student);

        if (! $request->user()->tokenCan('*')) {
            abort(403, 'This token does not have permission to update students.');
        }

        $student->update($this->validatedData($request));

        return new StudentResource($student->load('course'));
    }

    /** DELETE /api/students/{student} */
    public function destroy(Request $request, Student $student): JsonResponse
    {
        $this->authorize('delete', $student);

        if (! $request->user()->tokenCan('*')) {
            abort(403, 'This token does not have permission to delete students.');
        }

        $student->delete();

        return response()->json(['message' => 'Student deleted.']);
    }

    /** @return array<string, mixed> */
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'course_id' => ['nullable', 'exists:courses,id'],
            'full_name' => ['required', 'string', 'max:255'],
            'professional_title' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'skills' => ['nullable', 'string'],
            'project_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
        ]);
    }
}
