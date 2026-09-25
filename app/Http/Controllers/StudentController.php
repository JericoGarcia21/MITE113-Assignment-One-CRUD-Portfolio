<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        $students = Student::with('course')->latest()->paginate(10);

        return view('students.index', [
            'students' => $students,
        ]);
    }

    public function create(): View
    {
        $courses = Course::orderBy('name')->get();

        return view('students.create', [
            'courses' => $courses,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['user_id'] = Auth::id();

        $student = Student::create($data);

        return redirect()
            ->route('students.show', $student)
            ->with('status', 'Student created successfully.');
    }

    public function show(Student $student): View
    {
        $student->load('course');

        return view('students.show', [
            'student' => $student,
        ]);
    }

    public function edit(Student $student): View
    {
        $this->authorize('update', $student);

        $courses = Course::orderBy('name')->get();

        return view('students.edit', [
            'student' => $student,
            'courses' => $courses,
        ]);
    }

    public function update(Request $request, Student $student): RedirectResponse
    {
        $this->authorize('update', $student);

        $student->update($this->validatedData($request));

        return redirect()
            ->route('students.show', $student)
            ->with('status', 'Student updated successfully.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $this->authorize('delete', $student);

        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('status', 'Student deleted successfully.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'course_id'           => ['nullable', 'exists:courses,id'],
            'full_name'           => ['required', 'string', 'max:255'],
            'professional_title'  => ['required', 'string', 'max:255'],
            'email'               => ['nullable', 'email', 'max:255'],
            'phone'               => ['nullable', 'string', 'max:255'],
            'address'             => ['nullable', 'string', 'max:255'],
            'bio'                 => ['nullable', 'string'],
            'skills'              => ['nullable', 'string'],
            'project_url'         => ['nullable', 'url', 'max:255'],
            'github_url'          => ['nullable', 'url', 'max:255'],
            'linkedin_url'        => ['nullable', 'url', 'max:255'],
        ]);
    }
}
