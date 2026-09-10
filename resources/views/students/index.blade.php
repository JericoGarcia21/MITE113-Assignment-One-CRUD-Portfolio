<x-layouts.app title="Students">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <p class="text-uppercase text-primary fw-semibold small mb-1">Management</p>
            <h1 class="h3 mb-0">Students</h1>
        </div>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="list-group list-group-flush">
            @forelse ($students as $student)
                <div class="list-group-item">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                        <div>
                            <h2 class="h5 mb-1">{{ $student->full_name }}</h2>
                            <p class="text-primary fw-semibold small mb-1">{{ $student->professional_title }}</p>
                            @if ($student->course)
                                <span class="badge bg-secondary mb-1">{{ $student->course->name }}</span>
                            @endif
                            <p class="text-muted mb-0 small">{{ $student->bio ? Str::limit($student->bio, 100) : 'No bio added yet.' }}</p>
                        </div>
                        <div class="d-flex flex-wrap align-items-start gap-2 flex-shrink-0">
                            <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-outline-primary">View</a>
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form method="POST" action="{{ route('students.destroy', $student) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Delete this student?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="list-group-item text-center py-5">
                    <h2 class="h5">No students yet</h2>
                    <p class="text-muted mb-3">Add your first student to get started.</p>
                    <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
                </div>
            @endforelse
        </div>
    </div>

    <div class="mt-4">
        {{ $students->links() }}
    </div>
</x-layouts.app>
