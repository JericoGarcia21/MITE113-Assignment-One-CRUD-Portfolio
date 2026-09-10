<x-layouts.app title="Courses">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <p class="text-uppercase text-primary fw-semibold small mb-1">Management</p>
            <h1 class="h3 mb-0">Courses</h1>
        </div>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">Add Course</a>
    </div>

    {{-- Relationship info --}}
    <div class="alert alert-info d-flex align-items-center gap-2 mb-4" role="note">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="flex-shrink-0" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </svg>
        <span>Each <strong>course</strong> can have <strong>many students</strong>. Students are assigned to a course when added or edited.</span>
    </div>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="list-group list-group-flush">
            @forelse ($courses as $course)
                <div class="list-group-item">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                        <div>
                            <h2 class="h5 mb-1">{{ $course->name }}</h2>
                            <p class="text-muted mb-1 small">{{ $course->description ?: 'No description.' }}</p>
                            <span class="badge bg-primary bg-opacity-75 fs-6 px-3 py-1">
                                👥 {{ $course->students_count }} student{{ $course->students_count === 1 ? '' : 's' }}
                            </span>
                        </div>
                        <div class="d-flex flex-wrap align-items-start gap-2 flex-shrink-0">
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-outline-primary">View</a>
                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form method="POST" action="{{ route('courses.destroy', $course) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Delete this course? Students enrolled will be unassigned.')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="list-group-item text-center py-5">
                    <h2 class="h5">No courses yet</h2>
                    <p class="text-muted mb-3">Add your first course to get started.</p>
                    <a href="{{ route('courses.create') }}" class="btn btn-primary">Add Course</a>
                </div>
            @endforelse
        </div>
    </div>

    <div class="mt-4">
        {{ $courses->links() }}
    </div>
</x-layouts.app>
