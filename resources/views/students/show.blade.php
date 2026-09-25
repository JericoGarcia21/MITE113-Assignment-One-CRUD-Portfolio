<x-layouts.app title="{{ $student->full_name }}">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <p class="text-uppercase text-primary fw-semibold small mb-1">Student</p>
            <h1 class="h3 mb-1">{{ $student->full_name }}</h1>
            <p class="text-muted mb-0">{{ $student->professional_title }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Back</a>
            @can('update', $student)
                <a href="{{ route('students.edit', $student) }}" class="btn btn-primary">Edit</a>
            @endcan
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($student->course)
        <div class="mb-4">
            <span class="badge bg-primary fs-6">
                Course: {{ $student->course->name }}
            </span>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card card-body shadow-sm h-100">
                <h2 class="h5">Bio</h2>
                <p class="mb-4" style="white-space: pre-line;">{{ $student->bio ?: 'No bio added yet.' }}</p>

                <h2 class="h5">Skills</h2>
                <p class="mb-0" style="white-space: pre-line;">{{ $student->skills ?: 'No skills added yet.' }}</p>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card card-body shadow-sm h-100">
                <h2 class="h5">Contact &amp; Links</h2>
                <dl class="mb-0">
                    <div class="mb-2">
                        <dt class="text-muted small">Email</dt>
                        <dd class="text-break">{{ $student->email ?: 'Not added' }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-muted small">Phone</dt>
                        <dd class="text-break">{{ $student->phone ?: 'Not added' }}</dd>
                    </div>
                    <div class="mb-2">
                        <dt class="text-muted small">Address</dt>
                        <dd class="text-break">{{ $student->address ?: 'Not added' }}</dd>
                    </div>
                    @foreach (['project_url' => 'Project URL', 'github_url' => 'GitHub', 'linkedin_url' => 'LinkedIn'] as $field => $label)
                        <div class="mb-2">
                            <dt class="text-muted small">{{ $label }}</dt>
                            <dd class="text-break">
                                @if ($student->{$field})
                                    <a href="{{ $student->{$field} }}" target="_blank" rel="noopener noreferrer">{{ $student->{$field} }}</a>
                                @else
                                    Not added
                                @endif
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </div>
</x-layouts.app>
