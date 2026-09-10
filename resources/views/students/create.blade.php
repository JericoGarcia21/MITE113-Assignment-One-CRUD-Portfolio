<x-layouts.app title="Add Student">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <p class="text-uppercase text-primary fw-semibold small mb-1">Students</p>
            <h1 class="h3 mb-0">Add Student</h1>
        </div>
        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Back to list</a>
    </div>

    <form method="POST" action="{{ route('students.store') }}" class="card card-body shadow-sm">
        @include('students._form', ['buttonText' => 'Save Student'])
    </form>
</x-layouts.app>
