<x-layouts.app title="Add Course">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <p class="text-uppercase text-primary fw-semibold small mb-1">Courses</p>
            <h1 class="h3 mb-0">Add Course</h1>
        </div>
        <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>

    <form method="POST" action="{{ route('courses.store') }}" class="card card-body shadow-sm">
        @include('courses._form', ['buttonText' => 'Save Course'])
    </form>
</x-layouts.app>
