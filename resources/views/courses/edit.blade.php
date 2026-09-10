<x-layouts.app title="Edit Course">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <p class="text-uppercase text-primary fw-semibold small mb-1">Courses</p>
            <h1 class="h3 mb-0">Edit Course</h1>
        </div>
        <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-secondary">View Course</a>
    </div>

    <form method="POST" action="{{ route('courses.update', $course) }}" class="card card-body shadow-sm">
        @method('PUT')
        @include('courses._form', ['buttonText' => 'Update Course'])
    </form>
</x-layouts.app>
