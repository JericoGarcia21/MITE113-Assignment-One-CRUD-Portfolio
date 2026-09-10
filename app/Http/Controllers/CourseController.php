<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::withCount('students')->latest()->paginate(10);

        return view('courses.index', [
            'courses' => $courses,
        ]);
    }

    public function create(): View
    {
        return view('courses.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $course = Course::create($this->validatedData($request));

        return redirect()
            ->route('courses.show', $course)
            ->with('status', 'Course created successfully.');
    }

    public function show(Course $course): View
    {
        $course->load('students');

        return view('courses.show', [
            'course' => $course,
        ]);
    }

    public function edit(Course $course): View
    {
        return view('courses.edit', [
            'course' => $course,
        ]);
    }

    public function update(Request $request, Course $course): RedirectResponse
    {
        $course->update($this->validatedData($request));

        return redirect()
            ->route('courses.show', $course)
            ->with('status', 'Course updated successfully.');
    }

    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();

        return redirect()
            ->route('courses.index')
            ->with('status', 'Course deleted successfully.');
    }

    /**
     * @return array<string, string>
     */
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);
    }
}
