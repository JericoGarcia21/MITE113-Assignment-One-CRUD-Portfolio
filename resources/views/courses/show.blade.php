<x-layouts.app title="{{ $course->name }}">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <p class="text-uppercase text-primary fw-semibold small mb-1">Course</p>
            <h1 class="h3 mb-1">{{ $course->name }}</h1>
            <p class="text-muted mb-0">{{ $course->students->count() }} enrolled student{{ $course->students->count() === 1 ? '' : 's' }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">Back</a>
            <a href="{{ route('courses.edit', $course) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($course->description)
        <div class="card card-body shadow-sm mb-4">
            <h2 class="h5">Description</h2>
            <p class="mb-0" style="white-space: pre-line;">{{ $course->description }}</p>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">Enrolled Students</h2>
            <a href="{{ route('students.create') }}" class="btn btn-sm btn-outline-primary">Add Student</a>
        </div>
        <div class="list-group list-group-flush">
            @forelse ($course->students as $student)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <span class="fw-semibold">{{ $student->full_name }}</span>
                        <span class="text-muted small ms-2">{{ $student->professional_title }}</span>
                    </div>
                    <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-outline-primary">View</a>
                </div>
            @empty
                <div class="list-group-item text-center py-4 text-muted">
                    No students enrolled in this course yet.
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.app>
